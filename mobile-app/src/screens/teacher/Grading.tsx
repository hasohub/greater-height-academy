import React, { useEffect, useState } from 'react';
import { View, Text, ScrollView, StyleSheet, ActivityIndicator } from 'react-native';
import { GradingRecord } from '../../types';
import api from '../../services/api';

export default function TeacherGrading() {
  const [records, setRecords] = useState<GradingRecord[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    api.get('/teacher/grading').then((res) => {
      setRecords(res.data);
      setLoading(false);
    });
  }, []);

  if (loading) {
    return (
      <View style={styles.center}>
        <ActivityIndicator size="large" color="#4F46E5" />
      </View>
    );
  }

  return (
    <ScrollView contentContainerStyle={styles.container}>
      {records.map((r) => (
        <View key={r.id} style={styles.card}>
          <Text style={styles.student}>{r.student_name}</Text>
          <View style={styles.row}>
            <Text style={styles.exam}>{r.exam_title}</Text>
            <View style={[styles.badge, { backgroundColor: getBadgeBg(r.score) }]}>
              <Text style={[styles.badgeText, { color: getBadgeColor(r.score) }]}>{r.score}%</Text>
            </View>
          </View>
          <Text style={styles.subject}>{r.subject}</Text>
          <Text style={styles.date}>Graded: {new Date(r.graded_at).toLocaleDateString()}</Text>
        </View>
      ))}
      {records.length === 0 && <Text style={styles.empty}>No grading records found</Text>}
    </ScrollView>
  );
}

function getBadgeColor(score: number): string {
  if (score >= 80) return '#065F46';
  if (score >= 60) return '#1D4ED8';
  if (score >= 40) return '#92400E';
  return '#991B1B';
}
function getBadgeBg(score: number): string {
  if (score >= 80) return '#D1FAE5';
  if (score >= 60) return '#DBEAFE';
  if (score >= 40) return '#FEF3C7';
  return '#FEE2E2';
}

const styles = StyleSheet.create({
  container: { padding: 16, backgroundColor: '#f8fafc' },
  center: { flex: 1, justifyContent: 'center', alignItems: 'center' },
  card: { backgroundColor: '#fff', borderRadius: 16, padding: 16, marginBottom: 12, elevation: 2, shadowOpacity: 0.05, shadowRadius: 6 },
  student: { fontSize: 18, fontWeight: '600', color: '#111827' },
  row: { flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', marginTop: 8 },
  exam: { fontSize: 16, fontWeight: '500', color: '#4F46E5' },
  badge: { borderRadius: 8, paddingHorizontal: 10, paddingVertical: 4 },
  badgeText: { fontWeight: 'bold', fontSize: 14 },
  subject: { fontSize: 14, color: '#6B7280', marginTop: 6 },
  date: { fontSize: 12, color: '#9CA3AF', marginTop: 4, fontStyle: 'italic' },
  empty: { textAlign: 'center', color: '#9CA3AF', marginTop: 40 },
});
