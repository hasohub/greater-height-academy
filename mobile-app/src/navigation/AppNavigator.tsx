import React from 'react';
import { View, Text, ActivityIndicator, StyleSheet } from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { useAuth } from '../context/AuthContext';
import LoginScreen from '../screens/LoginScreen';
import StudentDashboard from '../screens/student/Dashboard';
import StudentTimetable from '../screens/student/Timetable';
import StudentGrades from '../screens/student/Grades';
import StudentFees from '../screens/student/Fees';
import TeacherDashboard from '../screens/teacher/Dashboard';
import TeacherSchedule from '../screens/teacher/Schedule';
import TeacherClasses from '../screens/teacher/Classes';
import TeacherGrading from '../screens/teacher/Grading';
import ParentDashboard from '../screens/parent/Dashboard';
import ParentTimetable from '../screens/parent/Timetable';
import ParentGrades from '../screens/parent/Grades';
import ParentFees from '../screens/parent/Fees';

const Tab = createBottomTabNavigator();

const roleBasedTabs = (role) => {
  if (role === 'student' || role === 'Student') {
    return [
      { name: 'StudentHome', component: StudentDashboard, label: 'Home', icon: '🏠' },
      { name: 'StudentTimetable', component: StudentTimetable, label: 'Timetable', icon: '📅' },
      { name: 'StudentGrades', component: StudentGrades, label: 'Grades', icon: '📊' },
      { name: 'StudentFees', component: StudentFees, label: 'Fees', icon: '💳' },
    ];
  }
  if (role === 'teacher' || role === 'Teacher') {
    return [
      { name: 'TeacherHome', component: TeacherDashboard, label: 'Home', icon: '🏠' },
      { name: 'TeacherSchedule', component: TeacherSchedule, label: 'Schedule', icon: '📅' },
      { name: 'TeacherClasses', component: TeacherClasses, label: 'Classes', icon: '👥' },
      { name: 'TeacherGrading', component: TeacherGrading, label: 'Grading', icon: '📝' },
    ];
  }
  if (role === 'parent' || role === 'Parent') {
    return [
      { name: 'ParentHome', component: ParentDashboard, label: 'Home', icon: '🏠' },
      { name: 'ParentTimetable', component: ParentTimetable, label: 'Timetable', icon: '📅' },
      { name: 'ParentGrades', component: ParentGrades, label: 'Grades', icon: '📊' },
      { name: 'ParentFees', component: ParentFees, label: 'Fees', icon: '💳' },
    ];
  }
  return [];
};

export default function AppNavigator() {
  const { user, loading } = useAuth();

  if (loading) {
    return (
      <View style={styles.loading}>
        <ActivityIndicator size="large" color="#4F46E5" />
        <Text>Loading…</Text>
      </View>
    );
  }

  if (!user) {
    return <LoginScreen />;
  }

  const tabs = roleBasedTabs(user.role);

  return (
    <NavigationContainer>
      <Tab.Navigator screenOptions={{ headerShown: false }}>
        {tabs.map((tab) => (
          <Tab.Screen
            key={tab.name}
            name={tab.name}
            component={tab.component}
            options={{ tabBarLabel: tab.label, tabBarIcon: () => <Text>{tab.icon}</Text> }}
          />
        ))}
      </Tab.Navigator>
    </NavigationContainer>
  );
}

const styles = StyleSheet.create({
  loading: { flex: 1, justifyContent: 'center', alignItems: 'center' },
});
