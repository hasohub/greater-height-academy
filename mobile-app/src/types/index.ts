// User
export interface User {
  id: number;
  name: string;
  email: string;
  role: string;
  phone?: string;
}

// Login
export interface LoginResponse {
  success: boolean;
  token?: string;
  user?: User;
  message?: string;
}

// Student Dashboard
export interface StudentDashboardData {
  attendance_rate: number;
  upcoming_exams: number;
  gpa: number;
  pending_fees: number;
}

// Teacher Dashboard
export interface TeacherDashboardData {
  subject_count: number;
  classes_today: number;
  upcoming_exams: number;
  recent_grades_count: number;
}

// Parent Dashboard
export interface ParentDashboardData {
  children: Array<{
    id: number;
    name: string;
    admission_no: string;
    attendance_rate: number;
    gpa: number;
    upcoming_exams: number;
    pending_fees: number;
  }>;
}

// Common
export interface TimetableEntry {
  id: number;
  weekday: number;
  subject: { name: string; code?: string };
  teacher: { user: { name: string } };
  myClass: { name: string };
  section: { name: string };
  timeSlot: { start_time: string; end_time: string };
  [key: string]: any;
}

export interface Grade {
  id: number;
  exam_title: string;
  subject: string;
  score: number;
  grade: string;
  remarks?: string;
  date?: string;
}

export interface FeeInvoice {
  id: number;
  amount: number;
  due_date: string;
  status: string;
  category: string;
  description?: string;
}

export interface Notice {
  id: number;
  title: string;
  content: string;
  created_at: string;
}

export interface ClassSubject {
  id: number;
  name: string;
  class: string;
  section: string;
  code: string;
}

export interface GradingRecord {
  id: number;
  student_name: string;
  exam_title: string;
  subject: string;
  score: number;
  grade: string;
  graded_at: string;
}
