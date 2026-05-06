import React, { createContext, useState, useEffect } from 'react';
import * as SecureStore from 'expo-secure-store';
import api from '../services/api';

export const AuthContext = createContext({
  user: null,
  token: null,
  loading: true,
  login: async () => {},
  logout: async () => {},
});

export const AuthProvider = ({ children }) => {
  const [user, setUser] = useState(null);
  const [token, setToken] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    bootstrap();
  }, []);

  const bootstrap = async () => {
    const storedToken = await SecureStore.getItemAsync('auth_token');
    if (storedToken) {
      try {
        const res = await api.get('/profile');
        setUser(res.data);
        setToken(storedToken);
      } catch (e) {
        await SecureStore.deleteItemAsync('auth_token');
      }
    }
    setLoading(false);
  };

  const login = async (email, password) => {
    const res = await api.post('/login', { email, password });
    if (res.data.success) {
      const { token: newToken, user: userData } = res.data;
      await SecureStore.setItemAsync('auth_token', newToken);
      setToken(newToken);
      setUser(userData);
      return { success: true };
    }
    return { success: false, message: res.data.message };
  };

  const logout = async () => {
    await api.post('/logout');
    await SecureStore.deleteItemAsync('auth_token');
    setUser(null);
    setToken(null);
  };

  return (
    <AuthContext.Provider value={{ user, token, loading, login, logout }}>
      {children}
    </AuthContext.Provider>
  );
};
