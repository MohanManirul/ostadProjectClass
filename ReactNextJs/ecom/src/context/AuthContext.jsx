import React, { createContext, useState, useContext, useEffect } from "react";
import axios from "axios";

const AuthContext = createContext();

const BASE_URL = "https://ecom-rs8e.onrender.com/api";

export function AuthProvider({ children }) {
  const [user, setUser] = useState(null);
  const [token, setToken] = useState(localStorage.getItem("token") || null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  console.log(
    "Initial token from localStorage:",
    localStorage.getItem("token")
  );

  useEffect(() => {
    if (token && !user) {
      console.log("Token found, fetching profile...");
      fetchProfile();
    }
  }, [token]);

  const login = async (email, password) => {
    try {
      setLoading(true);
      setError(null);

      console.log("Attempting login with:", { email, password });
      const response = await axios.post(`${BASE_URL}/auth/login`, {
        email,
        password,
      });

      console.log("Login response:", response.data);

      // Adjusted to match nested data structure
      const authToken = response.data.data?.token;
      const userData = response.data.data?.user;

      if (!authToken || !userData) {
        throw new Error("Invalid response structure from login API");
      }

      setToken(authToken);
      setUser(userData);
      localStorage.setItem("token", authToken);
      console.log("Token saved to localStorage:", authToken);
      console.log("User set:", userData);
    } catch (err) {
      console.error("Login error:", err.response?.data || err.message);
      setError(err.response?.data?.message || "Login failed");
      throw err;
    } finally {
      setLoading(false);
    }
  };

  const signup = async (userData) => {
    try {
      setLoading(true);
      setError(null);

      console.log("Attempting signup with:", userData);
      const response = await axios.post(`${BASE_URL}/auth/signup`, {
        first_name: userData.firstName,
        last_name: userData.lastName,
        email: userData.email,
        password: userData.password,
        phone: userData.phone,
        city: userData.city,
      });

      console.log("Signup response:", response.data);

      // Adjusted to match nested data structure
      const authToken = response.data.data?.token;
      const newUser = response.data.data?.user;

      if (!authToken || !newUser) {
        throw new Error("Invalid response structure from signup API");
      }

      setToken(authToken);
      setUser(newUser);
      localStorage.setItem("token", authToken);
      console.log("Token saved to localStorage:", authToken);
      console.log("User set:", newUser);
    } catch (err) {
      console.error("Signup error:", err.response?.data || err.message);
      setError(err.response?.data?.message || "Signup failed");
      throw err;
    } finally {
      setLoading(false);
    }
  };

  const fetchProfile = async () => {
    try {
      setLoading(true);
      setError(null);

      console.log("Fetching profile with token:", token);
      const response = await axios.get(`${BASE_URL}/auth/profile`, {
        headers: { token },
      });

      console.log("Profile response:", response.data);
      setUser(response.data.data || response.data); // Adjust based on API response
    } catch (err) {
      console.error("Profile fetch error:", err.response?.data || err.message);
      setError(err.response?.data?.message || "Failed to fetch profile");
      logout();
    } finally {
      setLoading(false);
    }
  };

  const updateProfile = async (profileData) => {
    try {
      setLoading(true);
      setError(null);

      const response = await axios.patch(
        `${BASE_URL}/auth/profile`,
        profileData,
        {
          headers: { token },
        }
      );

      console.log("Profile update response:", response.data);
      setUser(response.data.data || response.data);
      return response.data;
    } catch (err) {
      console.error("Update profile error:", err.response?.data || err.message);
      setError(err.response?.data?.message || "Failed to update profile");
      throw err;
    } finally {
      setLoading(false);
    }
  };

  const logout = () => {
    console.log("Logging out...");
    setUser(null);
    setToken(null);
    localStorage.removeItem("token");
  };

  const value = {
    user,
    token,
    loading,
    error,
    login,
    signup,
    logout,
    updateProfile,
    fetchProfile,
  };

  console.log("AuthContext value:", value);

  return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>;
}

export function useAuth() {
  const context = useContext(AuthContext);
  if (!context) {
    throw new Error("useAuth must be used within an AuthProvider");
  }
  return context;
}
