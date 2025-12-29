import Link from 'next/link';
import NavLinks from '@/app/ui/dashboard/nav-links';
import AcmeLogo from '@/app/ui/acme-logo';
import { PowerIcon } from '@heroicons/react/24/outline';

export default function SideCat() {
  return (
    <div className="flex h-full flex-row px-3 py-4 md:px-2">
      
      <div className="flex grow flex-col justify-between space-x-2 md:flex-row md:space-x-0 md:space-y-2">
        <NavLinks />
        <div className="hidden h-auto w-full grow rounded-md bg-gray-50 md:block"></div>
        <form>
          <button className="flex h-[48px] w-full grow items-center justify-center gap-2 rounded-md bg-gray-50 p-3 text-sm font-medium hover:bg-sky-100 hover:text-blue-600 md:flex-none md:justify-start md:p-2 md:px-3">
            
            <div className="hidden md:block">خروج</div>
            <PowerIcon className="w-6" />
          </button>
        </form>
      </div>
    </div>
  );
}
