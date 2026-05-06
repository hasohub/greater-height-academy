import React, { useEffect, useState } from 'react';
import { View, Text, ScrollView, StyleSheet, ActivityIndicator } from 'react-native';
import { TimetableEntry } from '../../types';
import api from '../../services/api';

const weekdayNames = ['', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

export default function ParentTimetable() {
  const [timetable, setTimetable] = useState<{ [key: number]: TimetableEntry[] }>({});
  const [childId, setChildId] = useState<number | null>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    // Get parent dashboard to read first child id
    api.get('/parent/dashboard').then((res) => {
      if (res.data.children.length > 0) {
        const id = res.data.children[0].id;
        setChildId(id);
        return api.get(`/parent/timetable/${id}`);
      }
      return Promise.resolve({ data: {} });
    }).then((res) => {
      setTimetable(res.data);
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
      {[1, 2, 3, 4, 5].map((day) => {
        const entries = timetable[day] || [];
        return (
          <View key={day} style={styles.dayBlock}>
            <Text style={styles.dayTitle}>{weekdayNames[day]}</Text>
            {entries.map((entry, idx) => (
              <View key={idx} style={styles.period}>
                <Text style={styles.time}>{entry.timeSlot?.start_time}–{entry.timeSlot?.end_time}</Text>
                <Text style={styles.subject}>{entry.subject?.name}</Text>
                <Text style={styles.teacher}>{entry.teacher?.user?.name}</Text>
              </View>
            ))}
          </View>
        );
      })}
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { padding: 16, backgroundColor: '#fff' },
  center: { flex: 1, justifyContent: 'center', alignItems: 'center' },
  dayBlock: { marginBottom: 24 },
  dayTitle: { fontSize: 18, fontWeight: 'bold', color: '#F59E0B', marginBottom: 8 },
  period: { backgroundColor: '#FFFBEB', padding: 12, borderRadius: 10, marginBottom: 6 },
  time: { fontSize: 12, color: '#6B7280' },
  subject: { fontSize: 16, fontWeight: '600', color: '#111827' },
  teacher: { fontSize: 14, color: '#4B5563' },
});
