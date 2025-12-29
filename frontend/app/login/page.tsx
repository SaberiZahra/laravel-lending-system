"use client";

import { useState } from "react";

const LoginPage: React.FC = () => {
  const [username, setUsername] = useState<string>("");
  const [password, setPassword] = useState<string>("");
  const [remember, setRemember] = useState<boolean>(false);

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();

    // نمونه لاگین (بعداً می‌توانید به API وصل کنید)
    console.log({
      username,
      password,
      remember,
    });
  };

  return (
    <div className="bg-gray-100 flex justify-center items-center h-screen">
      {/* Left: Image */}
      <div className="w-1/2 h-screen hidden lg:block">
        <img
          src="https://placehold.co/800x/667fff/ffffff.png?text=Your+Image&font=Montserrat"
          alt="Placeholder Image"
          className="object-cover w-full h-full"
        />
      </div>

      {/* Right: Login Form */}
      <div className=" lg:p-36 md:p-52 sm:p-20 p-8 w-full lg:w-1/2">
        <h1 className="text-2xl font-semibold mb-4 text-right">ورود</h1>

        <form onSubmit={handleSubmit}>
          {/* Username */}
          <div className="mb-4">
            <label htmlFor="username" className="block text-gray-600 text-right">
              نام کاربری
            </label>
            <input
              type="text"
              id="username"
              className="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500 text-right"
              value={username}
              onChange={(e) => setUsername(e.target.value)}
              autoComplete="off"
            />
          </div>

          {/* Password */}
          <div className="mb-4">
            <label htmlFor="password" className="block text-gray-600 text-right">
              رمزعبور
            </label>
            <input
              type="password"
              id="password"
              className="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500 text-right"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              autoComplete="off"
            />
          </div>

          {/* Remember Me */}
          <div className="mb-4 flex items-center justify-end">
            <label htmlFor="remember" className="text-gray-600 ml-2 text-right">
              من را به خاطر داشته باش
            </label>
            <input
              type="checkbox"
              id="remember"
              className="text-blue-500"
              checked={remember}
              onChange={(e) => setRemember(e.target.checked)}
            />
            
          </div>

          {/* Forgot Password */}
          <div className="flex justify-end mb-6 text-blue-500">
            <a href="#" className="hover:underline text-right">
              فراموشی رمز
            </a>
          </div>

          {/* Submit */}
          <button
            type="submit"
            className="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full"
          >
            ورود
          </button>
        </form>

        {/* Sign up */}
        <div className="mt-6 text-blue-500 text-center">
          <a href="/signUp" className="hover:underline">
            ثبت نام
          </a>
        </div>
      </div>
    </div>
  );
};

export default LoginPage;
