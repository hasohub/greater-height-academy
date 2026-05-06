import React, { useEffect, useState } from 'react';
import { View, Text, ScrollView, StyleSheet, ActivityIndicator } from 'react-native';
import { ClassSubject } from '../../types';
import api from '../../services/api';

export default function TeacherClasses() {
  const [classes, setClasses] = useState<ClassSubject[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    api.get('/teacher/classes').then((res) => {
      setClasses(res.data);
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
      {classes.map((cls) => (
        <View key={cls.id} style={styles.card}>
          <View style={[styles.badge, { backgroundColor: '#DBEAFE' }]}>
            <Text style={[styles.badgeText, { color: '#1D4ED8' }]}>{cls.code}</Text>
          </View>
          <Text style={styles.name}>{cls.name}</Text>
          <Text style={styles.classSec}>Class: {cls.class} • Section: {cls.section}</Text>
        </View>
      ))}
      {classes.length === 0 && <Text style={styles.empty}>No assigned classes found</Text>}
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { padding: 16, backgroundColor: '#f8fafc' },
  center: { flex: 1, justifyContent: 'center', alignItems: 'center' },
  card: { backgroundColor: '#fff', borderRadius: 16, padding: 16, marginBottom: 12, elevation: 2, shadowOpacity: 0.05, shadowRadius: 6 },
  badge: { alignSelf: 'flex-start', borderRadius: 8, paddingHorizontal: 12, paddingVertical: 4, marginBottom: 8 },
  badgeText: { fontSize: 12, fontWeight: 'bold' },
  name: { fontSize: 18, fontWeight: '600', color: '#111827' },
  classSec: { fontSize: 14, color: '#6B7280', marginTop: 4 },
  empty: { textAlign: 'center', color: '#9CA3AF', marginTop: 40 },
});
