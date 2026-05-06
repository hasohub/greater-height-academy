import React, { useEffect, useState } from 'react';
import { View, Text, ScrollView, StyleSheet, ActivityIndicator } from 'react-native';
import { TimetableEntry } from '../../types';
import api from '../../services/api';

const weekdayNames = ['', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

export default function StudentTimetable() {
  const [timetable, setTimetable] = useState<{ [key: number]: TimetableEntry[] }>({});
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    api.get('/student/timetable').then((res) => {
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
                <Text style={styles.location}>Rm {entry.myClass?.name} {entry.section?.name}</Text>
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
  dayTitle: { fontSize: 18, fontWeight: 'bold', color: '#4F46E5', marginBottom: 8 },
  period: {
    backgroundColor: '#F3F4F6',
    padding: 12,
    borderRadius: 10,
    marginBottom: 6,
  },
  time: { fontSize: 12, color: '#6B7280' },
  subject: { fontSize: 16, fontWeight: '600', color: '#111827' },
  teacher: { fontSize: 14, color: '#4B5563' },
  location: { fontSize: 12, color: '#9CA3AF' },
});
