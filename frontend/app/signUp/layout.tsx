"use client";

import { useState } from "react";
import {
  EyeIcon,
  EyeSlashIcon,
  EnvelopeIcon,
  LockClosedIcon,
  UserIcon
} from "@heroicons/react/24/outline";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from "@/components/ui/card";
import { Input } from "@/components/ui/input";

export default function SignupPage() {
  const [showPassword, setShowPassword] = useState(false);

  return (
    <div className="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
      <Card className="w-full max-w-md shadow-xl rounded-2xl">
        <CardHeader className="text-center space-y-2">
          <CardTitle className="text-2xl font-bold">ایجاد حساب کاربری</CardTitle>
          <CardDescription>
            برای ادامه، اطلاعات خود را وارد کنید
          </CardDescription>
        </CardHeader>

        <CardContent className="space-y-4">
          <div className="relative">
            <UserIcon className="absolute right-3 top-3 h-5 w-5 text-muted-foreground" />
            <Input
              dir="rtl"
              placeholder="نام و نام خانوادگی"
              className="pr-10"
            />
          </div>

          <div className="relative">
            <EnvelopeIcon className="absolute right-3 top-3 h-5 w-5 text-muted-foreground" />
            <Input
              dir="rtl"
              type="email"
              placeholder="ایمیل"
              className="pr-10"
            />
          </div>

          <div className="relative">
            <LockClosedIcon className="absolute right-3 top-3 h-5 w-5 text-muted-foreground" />
            <Input
              dir="rtl"
              type={showPassword ? "text" : "password"}
              placeholder="رمز عبور"
              className="pr-10 pl-10"
            />
            <button
              type="button"
              onClick={() => setShowPassword(!showPassword)}
              className="absolute left-3 top-3 text-muted-foreground"
            >
              {showPassword ? (
  <EyeSlashIcon className="h-5 w-5" />
) : (
  <EyeIcon className="h-5 w-5" />
)}
            </button>
          </div>

          <Button className="w-full text-base rounded-xl">
            ثبت نام
          </Button>

          <p className="text-sm text-center text-muted-foreground">
            قبلاً حساب دارید؟{" "}
            <a href="/login" className="text-primary hover:underline">
              وارد شوید
            </a>
          </p>
        </CardContent>
      </Card>
    </div>
  );
}
