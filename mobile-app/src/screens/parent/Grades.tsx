import React, { useEffect, useState } from 'react';
import { View, Text, ScrollView, StyleSheet, ActivityIndicator } from 'react-native';
import { Grade, FeeInvoice } from '../../types';
import api from '../../services/api';

export default function ParentGrades() {
  const [grades, setGrades] = useState<Grade[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    // First get child ID
    api.get('/parent/dashboard').then((res) => {
      const childId = res.data.children[0]?.id;
      if (childId) return api.get(`/parent/grades/${childId}`);
      return Promise.resolve({ data: [] });
    }).then((res) => {
      setGrades(res.data);
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
      {grades.map((g) => (
        <View key={g.id} style={styles.card}>
          <View style={styles.header}>
            <Text style={styles.exam}>{g.exam_title}</Text>
            <View style={[styles.badge, { backgroundColor: getBadgeColor(g.score) }]}>
              <Text style={styles.badgeText}>{g.score}%</Text>
            </View>
          </View>
          <Text style={styles.subject}>{g.subject} • {g.grade}</Text>
          {g.remarks && <Text style={styles.remarks}>{g.remarks}</Text>}
        </View>
      ))}
      {grades.length === 0 && <Text style={styles.empty}>No grades found</Text>}
    </ScrollView>
  );
}

function getBadgeColor(score: number): string {
  if (score >= 80) return '#D1FAE5';
  if (score >= 60) return '#DBEAFE';
  if (score >= 40) return '#FEF3C7';
  return '#FEE2E2';
}

const styles = StyleSheet.create({
  container: { padding: 16, backgroundColor: '#f8fafc' },
  center: { flex: 1, justifyContent: 'center', alignItems: 'center' },
  card: { backgroundColor: '#fff', borderRadius: 16, padding: 16, marginBottom: 12, elevation: 2, shadowOpacity: 0.05, shadowRadius: 6 },
  header: { flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', marginBottom: 8 },
  exam: { fontSize: 16, fontWeight: '600', color: '#111827', flex: 1 },
  badge: { borderRadius: 8, paddingHorizontal: 10, paddingVertical: 4 },
  badgeText: { fontWeight: 'bold', fontSize: 14, color: '#065F46' },
  subject: { fontSize: 14, color: '#6B7280' },
  remarks: { fontSize: 13, color: '#9CA3AF', marginTop: 6, fontStyle: 'italic' },
  empty: { textAlign: 'center', color: '#9CA3AF', marginTop: 40 },
});
