import AppLogo from '@/app/ui/acme-logo';
import { ArrowRightIcon, UserIcon , MagnifyingGlassIcon } from '@heroicons/react/24/outline';
import Link from 'next/link';
import {lusitana700} from '@/app/ui/fonts';
import {lusitana400} from '@/app/ui/fonts';
import Image from 'next/image';
import { title } from 'process';

export default function Page() {
  const items = [
    {id:1, title:"آیتم شماره 1"},
    {id:2, title:"آیتم شماره 2"},
    {id:3, title:"آیتم شماره 3"},
    {id:4, title:"آیتم شماره 4"},
    {id:5, title:"آیتم شماره 5"},
    {id:6, title:"آیتم شماره 6"}
  ]

  const categories = [
    {id:1, title:'دسته ی 1'},
    {id:2, title:'دسته ی 2'},
    {id:3, title:'دسته ی 3'},
    {id:4, title:'دسته ی 4'},
    {id:5, title:'دسته ی 5'},
  ]
  return (
    <main className="flex min-h-screen flex-col p-6">
      <div className="mt-4 flex grow flex-row gap-4 md:flex-col">
        <div className="flex flex-col gap-6 rounded-lg bg-gray-50 px-6 py-10 ml-auto">
        
          <p className={`${lusitana700.className} antialiased text-right text-xl`}>
            <strong>:دسته بندی ها</strong> 
          </p>
          <div className='flex gap-4 overflow-x-auto no-scrollbar pb-3'>
            {categories.map(category => (
              
                <div key={category.id} className='mt-3 text-right'>
                  <Link
                    href="/categories"
                    className="flex items-center gap-5 self-start rounded-lg bg-blue-500 px-6 py-3 text-sm font-medium text-white transition-colors hover:bg-blue-400 md:text-base"
                  >
                  <span>{category.title}</span> <UserIcon className="w-5 md:w-6" />
                  </Link>
                </div>
            ))}
        </div>
      </div>
        <div className="flex flex-col justify-right gap-6 rounded-lg bg-gray-50 px-6 py-10 ml-auto ">
        
          <p className={`${lusitana700.className} antialiased text-right text-xl`}>
            <strong>:جدیدترین ها</strong> 
          </p>
          <div className='flex gap-4 overflow-x-auto no-scrollbar pb-3'>
            {items.map(item => (
              
                <div key={item.id} className='mt-3 text-right'>
                  <Link
                    href="/category1"
                    className="flex items-center gap-5 self-start rounded-lg bg-blue-500 px-6 py-3 text-sm font-medium text-white transition-colors hover:bg-blue-400 md:text-base"
                  >
                  <span>{item.title}</span> <UserIcon className="w-5 md:w-6" />
                  </Link>
                </div>
                  
            ))}
          </div>
          
        </div>
        <div className="flex flex-col justify-right gap-6 rounded-lg px-6 py-10 ml-auto">
        
          <p className={`${lusitana700.className} antialiased text-right font-semibold text-xl`}>
            <strong>:بیشترین امانت شده ها</strong> 
          </p>
          <div className='flex gap-4 overflow-x-auto no-scrollbar pb-3'>
            {items.map(item => (
              
                <div key={item.id}>
              <div
                className={`p-7 rounded-xl bg-gray-50`}
              >
                <h3 className="text-xl font-semibold mb-7 text-right">
                  {item.title}
                </h3>
                
                <Link
                  href="#"
                  className=" inline-flex px-4 py-2 items-center justify-center  font-semibold rounded-md bg-white hover:bg-blue-500 hover:text-white transition-all duration-500 dark:bg-neutral-900 dark:hover:bg-blue-500 dark:hover:text-white md:text-base text-sm"
                >
                  مشاهده ی محصول
                <ArrowRightIcon/>
                    
                  
                </Link>
              </div>
            </div>
                  
            ))}
          </div>
          
        </div>
      </div>
    </main>
  );
}
