"use client";

import { useState, useEffect } from "react";
import { useRouter } from "next/navigation";
import { categoriesAPI, authAPI } from "@/lib/api";
import { isAuthenticated } from "@/lib/auth";
import Link from "next/link";

type Category = {
  id: number;
  title: string;
  description?: string;
  parent_id?: number | null;
  children?: Category[];
};

export default function AdminCategoriesPage() {
  const router = useRouter();
  const [categories, setCategories] = useState<Category[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");
  const [user, setUser] = useState<any>(null);
  const [showForm, setShowForm] = useState(false);
  const [editingCategory, setEditingCategory] = useState<Category | null>(null);
  const [formData, setFormData] = useState({
    title: "",
    description: "",
    parent_id: "",
  });

  useEffect(() => {
    if (!isAuthenticated()) {
      router.push("/login");
      return;
    }

    const fetchData = async () => {
      try {
        setLoading(true);
        const [categoriesData, userData] = await Promise.all([
          categoriesAPI.getAll(),
          authAPI.me().catch(() => null),
        ]);
        setCategories(categoriesData || []);
        setUser(userData);

        if (userData?.role !== 1) {
          router.push("/dashboard");
        }
      } catch (err: any) {
        setError("خطا در دریافت دسته‌بندی‌ها");
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, [router]);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setError("");

    try {
      if (editingCategory) {
        await categoriesAPI.update(editingCategory.id, {
          title: formData.title.trim(),
          description: formData.description.trim() || null,
          parent_id: formData.parent_id ? Number(formData.parent_id) : null,
        });
      } else {
        await categoriesAPI.create({
          title: formData.title.trim(),
          description: formData.description.trim() || null,
          parent_id: formData.parent_id ? Number(formData.parent_id) : null,
        });
      }

      const data = await categoriesAPI.getAll();
      setCategories(data || []);
      setShowForm(false);
      setEditingCategory(null);
      setFormData({ title: "", description: "", parent_id: "" });
    } catch (err: any) {
      setError(err.response?.data?.message || "خطا در ذخیره دسته‌بندی");
    }
  };

  const handleDelete = async (id: number) => {
    if (!confirm("آیا مطمئن هستید که می‌خواهید این دسته‌بندی و زیرمجموعه‌های آن را حذف کنید؟")) return;

    try {
      await categoriesAPI.delete(id);
      const data = await categoriesAPI.getAll();
      setCategories(data || []);
    } catch (err: any) {
      setError(err.response?.data?.message || "خطا در حذف دسته‌بندی");
    }
  };

  const handleEdit = (category: Category) => {
    setEditingCategory(category);
    setFormData({
      title: category.title,
      description: category.description || "",
      parent_id: category.parent_id?.toString() || "",
    });
    setShowForm(true);
  };

  if (loading) {
    return (
        <div className="min-h-screen bg-gray-50 flex items-center justify-center">
          <div className="text-center">
            <div className="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-indigo-600 mx-auto"></div>
            <p className="mt-6 text-lg text-gray-700">در حال بارگذاری دسته‌بندی‌ها...</p>
          </div>
        </div>
    );
  }

  if (user?.role !== 1) {
    return null;
  }

  const getAllCategoriesFlat = (cats: Category[]): Category[] => {
    const result: Category[] = [];
    const flatten = (items: Category[]) => {
      items.forEach((item) => {
        result.push(item);
        if (item.children) flatten(item.children);
      });
    };
    flatten(cats);
    return result;
  };

  const allCategories = getAllCategoriesFlat(categories);

  return (
      <div className="min-h-screen bg-gray-50">
        {/* هدر زیبا */}
        <div dir="rtl" className="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-3xl p-10 mx-4 sm:mx-8 lg:mx-auto lg:max-w-6xl my-12 text-white shadow-2xl">
          <div className="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
            <div>
              <h1 className="text-4xl font-bold mb-3">مدیریت دسته‌بندی‌ها</h1>
              <p className="text-xl text-blue-100">افزودن، ویرایش و حذف دسته‌بندی‌های کالا</p>
            </div>
            <div className="flex gap-4">
              <Link
                  href="/dashboard"
                  className="px-8 py-4 bg-white/20 backdrop-blur rounded-2xl hover:bg-white/30 transition font-medium text-center"
              >
                ← بازگشت به داشبورد
              </Link>
            </div>
          </div>
        </div>

        {/* محتوای اصلی — راست‌چین */}
        <div dir="rtl" className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
          {error && (
              <div className="bg-red-50 border-2 border-red-300 text-red-800 px-8 py-5 rounded-2xl mb-10 text-center font-medium">
                ⚠️ {error}
              </div>
          )}

          {/* فرم افزودن/ویرایش */}
          <div className="bg-white rounded-3xl shadow-2xl p-8 mb-12 border">
            <div className="flex items-center justify-between mb-8">
              <h2 className="text-2xl font-bold text-gray-900">
                {editingCategory ? "ویرایش دسته‌بندی" : "افزودن دسته‌بندی جدید"}
              </h2>
              <button
                  onClick={() => {
                    setShowForm(!showForm);
                    if (!showForm) {
                      setEditingCategory(null);
                      setFormData({ title: "", description: "", parent_id: "" });
                    }
                  }}
                  className="px-6 py-3 bg-indigo-600 text-white font-medium rounded-2xl hover:bg-indigo-700 transition"
              >
                {showForm ? "انصراف" : "+ افزودن دسته‌بندی"}
              </button>
            </div>

            {showForm && (
                <form onSubmit={handleSubmit} className="space-y-6">
                  <div>
                    <label className="block text-base font-semibold text-gray-700 mb-2">
                      عنوان دسته‌بندی <span className="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        value={formData.title}
                        onChange={(e) => setFormData({ ...formData, title: e.target.value })}
                        required
                        className="w-full border-2 border-gray-300 rounded-xl px-5 py-3 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition"
                        placeholder="مثال: ابزارآلات برقی"
                    />
                  </div>

                  <div>
                    <label className="block text-base font-semibold text-gray-700 mb-2">
                      توضیحات (اختیاری)
                    </label>
                    <textarea
                        value={formData.description}
                        onChange={(e) => setFormData({ ...formData, description: e.target.value })}
                        rows={3}
                        className="w-full border-2 border-gray-300 rounded-xl px-5 py-3 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 resize-none transition"
                        placeholder="توضیح مختصر درباره این دسته‌بندی"
                    />
                  </div>

                  <div>
                    <label className="block text-base font-semibold text-gray-700 mb-2">
                      دسته‌بندی والد (اختیاری)
                    </label>
                    <select
                        value={formData.parent_id}
                        onChange={(e) => setFormData({ ...formData, parent_id: e.target.value })}
                        className="w-full border-2 border-gray-300 rounded-xl px-5 py-3 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition"
                    >
                      <option value="">بدون والد (دسته اصلی)</option>
                      {allCategories
                          .filter((cat) => !editingCategory || cat.id !== editingCategory.id)
                          .map((cat) => (
                              <option key={cat.id} value={cat.id}>
                                {cat.title}
                              </option>
                          ))}
                    </select>
                  </div>

                  <div className="pt-4">
                    <button
                        type="submit"
                        className="w-full py-4 bg-gradient-to-r from-indigo-600 to-blue-600 text-white font-bold rounded-2xl hover:from-indigo-700 hover:to-blue-700 transition shadow-lg"
                    >
                      {editingCategory ? "ذخیره تغییرات" : "ایجاد دسته‌بندی"}
                    </button>
                  </div>
                </form>
            )}
          </div>

          {/* لیست دسته‌بندی‌ها — درخت زیبا */}
          <div className="bg-white rounded-3xl shadow-2xl p-8 border">
            <h2 className="text-2xl font-bold text-gray-900 mb-8">لیست دسته‌بندی‌ها</h2>

            {categories.length === 0 ? (
                <div className="text-center py-16">
                  <p className="text-xl text-gray-500">هنوز دسته‌بندی‌ای ایجاد نشده است.</p>
                  <p className="text-gray-400 mt-3">با دکمه بالا اولین دسته‌بندی را اضافه کنید.</p>
                </div>
            ) : (
                <div className="space-y-4">
                  {categories.map((category) => (
                      <CategoryTree
                          key={category.id}
                          category={category}
                          onEdit={handleEdit}
                          onDelete={handleDelete}
                          level={0}
                      />
                  ))}
                </div>
            )}
          </div>
        </div>
      </div>
  );
}

// کامپوننت درخت دسته‌بندی — خیلی زیبا و مرتب
function CategoryTree({
                        category,
                        onEdit,
                        onDelete,
                        level,
                      }: {
  category: Category;
  onEdit: (cat: Category) => void;
  onDelete: (id: number) => void;
  level: number;
}) {
  const hasChildren = category.children && category.children.length > 0;

  return (
      <div className={`rounded-2xl border ${level === 0 ? "bg-gradient-to-r from-indigo-50 to-blue-50 border-indigo-200" : "bg-gray-50 border-gray-200"} p-6 shadow hover:shadow-md transition`}>
        <div className="flex items-center justify-between">
          <div className="flex items-center gap-4">
            {hasChildren && (
                <div className="w-8 h-8 rounded-full bg-indigo-200 flex items-center justify-center text-indigo-700 font-bold text-sm">
                  {category.children?.length}
                </div>
            )}
            <div>
              <h3 className="text-lg font-bold text-gray-900">{category.title}</h3>
              {category.description && (
                  <p className="text-sm text-gray-600 mt-1">{category.description}</p>
              )}
            </div>
          </div>

          <div className="flex gap-3">
            <button
                onClick={() => onEdit(category)}
                className="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition text-sm font-medium"
            >
              ویرایش
            </button>
            <button
                onClick={() => onDelete(category.id)}
                className="px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition text-sm font-medium"
            >
              حذف
            </button>
          </div>
        </div>

        {/* زیرمجموعه‌ها */}
        {hasChildren && (
            <div className="mt-6 mr-10 space-y-4 border-r-2 border-dashed border-gray-300 pr-6">
              {category.children!.map((child) => (
                  <CategoryTree
                      key={child.id}
                      category={child}
                      onEdit={onEdit}
                      onDelete={onDelete}
                      level={level + 1}
                  />
              ))}
            </div>
        )}
      </div>
  );
}