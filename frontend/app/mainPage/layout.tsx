import AppLogo from '@/app/ui/acme-logo';
import { ArrowRightIcon, UserIcon , MagnifyingGlassIcon } from '@heroicons/react/24/outline';
import Link from 'next/link';
import {lusitana700} from '@/app/ui/fonts';
import {lusitana400} from '@/app/ui/fonts';
import Image from 'next/image';
import { title } from 'process';

export default function Layout({ children }: { children: React.ReactNode }) {
  return (
    <main>
    <div className="h-screen grid grid-cols-3 shrink-0 items-center rounded-lg bg-blue-500 p-4 md:h-52">
        <div className="flex flex-row justify-start">
            <Link
            href="/login"
            className="flex items-center gap-5 self-start rounded-lg bg-blue-500 px-6 py-3 text-sm font-medium text-white transition-colors hover:bg-blue-400 md:text-base"
          >
            <span>ورود / ثبت نام</span> <UserIcon className="w-5 md:w-6" />
          </Link>
          </div>
         
        <div className="flex flex-row justify-center">
          <input 
            type='text'
            placeholder='جستجو...'
            className='border border-gray-300 rounded-lg px-4 py-2 w-80'> 
          </input>
          <Link
            /* this link should fix*/
            href="/login"
            className="flex items-center gap-5 self-start rounded-lg bg-blue-500 px-6 py-3 text-sm font-medium text-white transition-colors hover:bg-blue-400 md:text-base"
          >
            <span>جستجو</span> <MagnifyingGlassIcon className="w-5 md:w-6" />
          </Link>  
        </div>    

        <Link
        className="mb-2 flex h-20 items-end justify-end rounded-md bg-blue-500 p-4 md:h-40"
        href="/"
        >
            <div className="w-32 text-white md:w-40">
                <AppLogo />
            </div>
        </Link>  
        

      </div>
      
        <div>{children}</div>
         
      </main>
  );
}