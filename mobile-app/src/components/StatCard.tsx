import React from 'react';
import { View, Text, StyleSheet } from 'react-native';

interface StatCardProps {
  label: string;
  value: string | number;
  color: string;
  icon?: string;
}

export default function StatCard({ label, value, color, icon }: StatCardProps) {
  return (
    <View style={[styles.card, { borderLeftWidth: 4, borderLeftColor: color }]}>
      <Text style={styles.icon}>{icon}</Text>
      <Text style={styles.value}>{value}</Text>
      <Text style={styles.label}>{label}</Text>
    </View>
  );
}

const styles = StyleSheet.create({
  card: {
    backgroundColor: '#fff',
    borderRadius: 16,
    padding: 16,
    flex: 1,
    marginHorizontal: 6,
    marginVertical: 6,
    elevation: 2,
    shadowColor: '#000',
    shadowOpacity: 0.05,
    shadowRadius: 6,
    shadowOffset: { width: 0, height: 2 },
    alignItems: 'center',
  },
  icon: { fontSize: 24, marginBottom: 4 },
  value: { fontSize: 22, fontWeight: 'bold', color: '#111827' },
  label: { fontSize: 13, color: '#6B7280', marginTop: 4, textAlign: 'center' },
});
