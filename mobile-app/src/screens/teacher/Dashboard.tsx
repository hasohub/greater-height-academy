import React, { useEffect, useState } from 'react';
import { View, Text, ScrollView, StyleSheet, ActivityIndicator } from 'react-native';
import { TeacherDashboardData } from '../../types';
import StatCard from '../../components/StatCard';
import DashboardCard from '../../components/DashboardCard';
import api from '../../services/api';

export default function TeacherDashboard() {
  const [data, setData] = useState<TeacherDashboardData | null>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    api.get('/teacher/dashboard').then((res) => {
      setData(res.data);
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
    <ScrollView style={styles.container}>
      <View style={styles.row}>
        <StatCard label="Subjects" value={data?.subject_count} color="#4F46E5" icon="📚" />
        <StatCard label="Today's Classes" value={data?.classes_today} color="#10B981" icon="🏫" />
      </View>
      <View style={styles.row}>
        <StatCard label="Upcoming Exams" value={data?.upcoming_exams} color="#F59E0B" icon="✏️" />
        <StatCard label="Graded" value={data?.recent_grades_count} color="#EF4444" icon="✅" />
      </View>

      <Text style={styles.sectionTitle}>Quick Actions</Text>
      <View style={styles.grid}>
        <DashboardCard title="My Timetable" icon="📅" color="#4F46E5" />
        <DashboardCard title="Enter Grades" icon="📝" color="#10B981" />
        <DashboardCard title="Manage Exams" icon="✏️" color="#F59E0B" />
        <DashboardCard title="Send SMS" icon="💬" color="#6366F1" />
      </View>
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#f8fafc' },
  row: { flexDirection: 'row', flexWrap: 'wrap' },
  center: { flex: 1, justifyContent: 'center', alignItems: 'center' },
  sectionTitle: { fontSize: 20, fontWeight: 'bold', margin: 16, color: '#111827' },
  grid: { flexDirection: 'row', flexWrap: 'wrap', paddingHorizontal: 4 },
});
