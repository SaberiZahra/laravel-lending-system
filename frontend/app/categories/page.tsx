import React from "react";
import { ReactNode } from "react";
import Link from 'next/link';
import Image from 'next/image';
import { BookOpenIcon, CakeIcon , GlobeAltIcon } from "@heroicons/react/20/solid";

interface CategoryItem {
  title: string;
  description: string;
  bgClass: string;
  image: string;
  
}

const Categories: CategoryItem[] = [
  {
    title: "لوازم آرایشی",
    description: "انواع لوازم آرایشی از برندهای مختلف را کاربران با شما به اشتراک میگذارند",
    bgClass: "bg-gray-50",
    image:'/makeup.jpg',
    
  },
  {
    title: "بازی و سرگرمی",
    description:
      "انواع بازی های فکری و گروهی و حتی بازی های کامپیوتری رو اینجا می تونی پیدا کنی",
    bgClass: "bg-gray-50",
    image: '/Games.jpg',
  },
  {
    title: "لواز آشپزی",
    description:
      "وسایلی که توی هر آشپزخانه ای می تونه باشه یا لازمه که باشه",
    bgClass: "bg-gray-50",
    image:'/cooking.jpg',
  },
  {
    title: "ابزار آلات",
    description:
      "هر مدل ابزاری که برای تعمیر هر چیزی می تونه لازمت بشه",
    bgClass: "bg-gray-50",
    image: '/mechanic.jpg',
  },
  {
    title: "کتاب",
    description:
      "انواع کتاب ها در ژانرها و نویسنده های مختلف که خیلی وقتا پولشون رو نداری",
    bgClass: "bg-gray-50",
    image: '/book.jpg',
  },
  {
    title: "لوازم ورزشی",
    description:
      "خیلی وقتا میخواهی بری باشگاه ولی پولشو نداری و لوازمش رو هم نداری :( اینجا دیگه از این نگرانی ها خبری نیست",
    bgClass: "bg-gray-50",
    image:'/gym.jpg',
  },
];

const ServicesSection: React.FC = () => {
  return (
    <div className="py-20">
      <div className="container">
        

        <div className="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6 mt-16">
          {Categories.map((Category, index) => (
            <div key={index}>
              <div
                className={`p-7 rounded-xl ${Category.bgClass}`}
              >
                
                  <h3 className="text-xl font-semibold mb-7 text-right">
                    {Category.title}
                  </h3>
                 
                
                <Image
        src={Category.image}
        width={1000}
        height={760}
        className="hidden md:block"
        alt="Screenshots of the dashboard project showing desktop version"
      />
                <p className="font-medium leading-7 text-black mb-6  text-right">
                  {Category.description}
                </p>
                <Link
                  href="#"
                  className="py-3 flex items-center justify-center w-full font-semibold rounded-md bg-white hover:bg-blue-500 hover:text-white transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-blue-500 dark:hover:text-white"
                >
                  بزن بریم
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 448 512"
                    className="h-5 w-5 ms-3"
                  >
                    <path
                      fill="currentColor"
                      d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"
                    />
                  </svg>
                </Link>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

export default ServicesSection;
