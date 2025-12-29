import { GlobeAltIcon , ShareIcon} from '@heroicons/react/24/outline';
import { lusitana } from '@/app/ui/fonts';

export default function AppLogo() {
  return (
    <div
      className={`${lusitana.className} flex flex-row items-center leading-none text-white`}
    >
      <ShareIcon className="ml-auto h-12 w-12 rotate-[15deg] " />
      <p className="text-[44px] text-right pl-6">بده بستون</p>
    </div>
  );
}
