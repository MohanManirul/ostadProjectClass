import React from "react";
import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import * as z from "zod";
import { useNavigate } from "react-router-dom";
import { useAuth } from "../context/AuthContext";

const signupSchema = z.object({
  firstName: z.string().min(1, "First name is required"),
  lastName: z.string().min(1, "Last name is required"),
  email: z.string().email("Invalid email address"),
  password: z.string().min(6, "Password must be at least 6 characters"),
  phone: z
    .string()
    .min(10, "Phone number must be at least 10 digits")
    .optional(),
  city: z.string().optional(),
});

const SignupPage = () => {
  const { signup } = useAuth();
  const navigate = useNavigate();
  const {
    register,
    handleSubmit,
    formState: { errors, isSubmitting },
  } = useForm({
    resolver: zodResolver(signupSchema),
  });

  const onSubmit = async (data) => {
    try {
      await signup(data);
      navigate("/"); // Redirect to home page after successful signup
    } catch (err) {
      console.log("Signup error:", err);
    }
  };

  return (
    <div className="container mx-auto">
      <div className="grid grid-cols-1 mt-2 md:grid-cols-1 lg:grid-cols-1 gap-3">
        <div className="flex items-center w-full justify-center h-screen">
          <div className="card w-8/12 card-side bg-white shadow-xl">
            <figure>
              <img
                className="h-96 w-96"
                src="/images/login-banner.png"
                alt="Signup"
              />
            </figure>
            <div className="card-body justify-center items-center">
              <div className="w-8/12">
                <h1 className="text-2xl my-4">CREATE ACCOUNT</h1>
                <p className="mb-4 text-sm text-gray-600">
                  Fill in your details to sign up
                </p>
                <form onSubmit={handleSubmit(onSubmit)}>
                  <div className="mb-4">
                    <input
                      {...register("firstName")}
                      type="text"
                      placeholder="First Name"
                      className="input w-full bg-white rounded-lg input-bordered"
                    />
                    {errors.firstName && (
                      <p className="text-red-500 text-sm mt-1">
                        {errors.firstName.message}
                      </p>
                    )}
                  </div>
                  <div className="mb-4">
                    <input
                      {...register("lastName")}
                      type="text"
                      placeholder="Last Name"
                      className="input w-full bg-white rounded-lg input-bordered"
                    />
                    {errors.lastName && (
                      <p className="text-red-500 text-sm mt-1">
                        {errors.lastName.message}
                      </p>
                    )}
                  </div>
                  <div className="mb-4">
                    <input
                      {...register("email")}
                      type="email"
                      placeholder="Email"
                      className="input w-full bg-white rounded-lg input-bordered"
                    />
                    {errors.email && (
                      <p className="text-red-500 text-sm mt-1">
                        {errors.email.message}
                      </p>
                    )}
                  </div>
                  <div className="mb-4">
                    <input
                      {...register("password")}
                      type="password"
                      placeholder="Password"
                      className="input w-full bg-white rounded-lg input-bordered"
                    />
                    {errors.password && (
                      <p className="text-red-500 text-sm mt-1">
                        {errors.password.message}
                      </p>
                    )}
                  </div>
                  <div className="mb-4">
                    <input
                      {...register("phone")}
                      type="text"
                      placeholder="Phone (optional)"
                      className="input w-full bg-white rounded-lg input-bordered"
                    />
                    {errors.phone && (
                      <p className="text-red-500 text-sm mt-1">
                        {errors.phone.message}
                      </p>
                    )}
                  </div>
                  <div className="mb-4">
                    <input
                      {...register("city")}
                      type="text"
                      placeholder="City (optional)"
                      className="input w-full bg-white rounded-lg input-bordered"
                    />
                    {errors.city && (
                      <p className="text-red-500 text-sm mt-1">
                        {errors.city.message}
                      </p>
                    )}
                  </div>
                  <button
                    type="submit"
                    disabled={isSubmitting}
                    className="btn rounded-lg w-full my-4 btn-primary"
                  >
                    {isSubmitting ? "Signing up..." : "Sign Up"}
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default SignupPage;
