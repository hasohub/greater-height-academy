import React from 'react';
import { View, Text, TouchableOpacity, StyleSheet } from 'react-native';

interface DashboardCardProps {
  title: string;
  value?: string | number;
  subtitle?: string;
  icon: string;
  color: string;
  onPress?: () => void;
}

export default function DashboardCard({ title, value, subtitle, icon, color, onPress }: DashboardCardProps) {
  const Content = (
    <View style={[styles.card, { borderLeftWidth: 4, borderLeftColor: color }]}>
      <Text style={styles.icon}>{icon}</Text>
      <Text style={styles.title}>{title}</Text>
      {value !== undefined && <Text style={styles.value}>{value}</Text>}
      {subtitle && <Text style={styles.subtitle}>{subtitle}</Text>}
    </View>
  );

  if (onPress) {
    return (
      <TouchableOpacity onPress={onPress} activeOpacity={0.7}>
        {Content}
      </TouchableOpacity>
    );
  }
  return Content;
}

const styles = StyleSheet.create({
  card: {
    backgroundColor: '#fff',
    borderRadius: 16,
    padding: 20,
    margin: 8,
    minWidth: 150,
    elevation: 2,
    shadowColor: '#000',
    shadowOpacity: 0.05,
    shadowRadius: 6,
    shadowOffset: { width: 0, height: 2 },
    alignItems: 'center',
  },
  icon: { fontSize: 32, marginBottom: 12 },
  title: { fontSize: 16, fontWeight: '600', color: '#111827', textAlign: 'center' },
  value: { fontSize: 24, fontWeight: 'bold', color: color, marginTop: 4 },
  subtitle: { fontSize: 13, color: '#6B7280', marginTop: 4, textAlign: 'center' },
});
