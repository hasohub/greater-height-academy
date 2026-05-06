import React, { useEffect, useState } from 'react';
import { View, Text, ScrollView, StyleSheet, ActivityIndicator, TouchableOpacity } from 'react-native';
import { ParentDashboardData } from '../../types';
import StatCard from '../../components/StatCard';
import DashboardCard from '../../components/DashboardCard';
import api from '../../services/api';

export default function ParentDashboard() {
  const [data, setData] = useState<ParentDashboardData | null>(null);
  const [selectedChildId, setSelectedChildId] = useState<number | null>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    api.get('/parent/dashboard').then((res) => {
      setData(res.data);
      if (res.data.children.length > 0) setSelectedChildId(res.data.children[0].id);
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

  const child = data?.children.find((c) => c.id === selectedChildId) || data?.children[0];

  return (
    <ScrollView style={styles.container}>
      {data && data.children.length > 1 && (
        <View style={styles.selector}>
          {data.children.map((c) => (
            <TouchableOpacity
              key={c.id}
              style={[styles.option, selectedChildId === c.id && styles.activeOption]}
              onPress={() => setSelectedChildId(c.id)}
            >
              <Text style={selectedChildId === c.id ? styles.activeText : styles.optionText}>{c.name}</Text>
            </TouchableOpacity>
          ))}
        </View>
      )}

      {child && (
        <>
          <View style={styles.row}>
            <StatCard label="Attendance" value={`${child.attendance_rate}%`} color="#10B981" icon="📅" />
            <StatCard label="GPA" value={child.gpa.toFixed(2)} color="#4F46E5" icon="📊" />
          </View>
          <View style={styles.row}>
            <StatCard label="Upcoming Exams" value={child.upcoming_exams} color="#F59E0B" icon="✏️" />
            <StatCard label="Pending Fees" value={`$${child.pending_fees}`} color="#EF4444" icon="💰" />
          </View>

          <Text style={styles.sectionTitle}>Quick Actions</Text>
          <View style={styles.grid}>
            <DashboardCard title="Timetable" icon="📅" color="#4F46E5" />
            <DashboardCard title="Grades" icon="📊" color="#10B981" />
            <DashboardCard title="Fee Invoices" icon="🧾" color="#F59E0B" />
            <DashboardCard title="Notices" icon="📢" color="#EF4444" />
          </View>
        </>
      )}
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#f8fafc' },
  row: { flexDirection: 'row', flexWrap: 'wrap' },
  center: { flex: 1, justifyContent: 'center', alignItems: 'center' },
  sectionTitle: { fontSize: 20, fontWeight: 'bold', margin: 16, color: '#111827' },
  grid: { flexDirection: 'row', flexWrap: 'wrap', paddingHorizontal: 4 },
  selector: { flexDirection: 'row', padding: 12, justifyContent: 'center', flexWrap: 'wrap' },
  option: { paddingHorizontal: 16, paddingVertical: 8, margin: 4, borderRadius: 20, backgroundColor: '#fff', borderWidth: 1, borderColor: '#E5E7EB' },
  activeOption: { backgroundColor: '#4F46E5', borderColor: '#4F46E5' },
  optionText: { color: '#6B7280' },
  activeText: { color: '#fff', fontWeight: '600' },
});
