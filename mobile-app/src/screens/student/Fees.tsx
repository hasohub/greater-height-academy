import React, { useEffect, useState } from 'react';
import { View, Text, ScrollView, StyleSheet, ActivityIndicator } from 'react-native';
import { FeeInvoice } from '../../types';
import api from '../../services/api';

export default function StudentFees() {
  const [fees, setFees] = useState<FeeInvoice[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    api.get('/student/fees').then((res) => {
      setFees(res.data);
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
      {fees.map((fee) => (
        <View key={fee.id} style={styles.card}>
          <View style={styles.header}>
            <Text style={styles.category}>{fee.category}</Text>
            <View style={[styles.status, fee.status === 'paid' ? styles.paid : styles.unpaid]}>
              <Text style={styles.statusText}>{fee.status.toUpperCase()}</Text>
            </View>
          </View>
          <Text style={styles.amount}>${fee.amount.toFixed(2)}</Text>
          <Text style={styles.due}>Due: {fee.due_date}</Text>
          {fee.description && <Text style={styles.desc}>{fee.description}</Text>}
        </View>
      ))}
      {fees.length === 0 && <Text style={styles.empty}>No outstanding invoices</Text>}
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { padding: 16, backgroundColor: '#f8fafc' },
  center: { flex: 1, justifyContent: 'center', alignItems: 'center' },
  card: { backgroundColor: '#fff', borderRadius: 16, padding: 16, marginBottom: 12, elevation: 2, shadowOpacity: 0.05, shadowRadius: 6 },
  header: { flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', marginBottom: 8 },
  category: { fontSize: 16, fontWeight: '600', color: '#111827' },
  status: { paddingHorizontal: 8, paddingVertical: 4, borderRadius: 6 },
  paid: { backgroundColor: '#D1FAE5' },
  unpaid: { backgroundColor: '#FEE2E2' },
  statusText: { fontSize: 12, fontWeight: 'bold', color: '#065F46' },
  amount: { fontSize: 24, fontWeight: 'bold', color: '#4F46E5', marginVertical: 4 },
  due: { fontSize: 14, color: '#6B7280' },
  desc: { fontSize: 13, color: '#9CA3AF', marginTop: 6 },
  empty: { textAlign: 'center', color: '#9CA3AF', marginTop: 40 },
});
