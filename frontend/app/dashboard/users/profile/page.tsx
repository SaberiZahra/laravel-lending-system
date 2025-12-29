export default function ProfilePage() {
  return (
    <div className="space-y-8">
      {/* Header */}
      <section className="bg-white rounded-2xl shadow p-6 flex items-center gap-6">
        <div className="h-24 w-24 rounded-full bg-slate-200" />

        <div>
          <h1 className="text-2xl font-bold">سارا مهدی آبادی</h1>
          <p className="text-slate-500">@sara_mehdiabadi</p>

          <div className="mt-2 flex items-center gap-2">
            <span className="text-sm bg-amber-100 text-amber-700 px-3 py-1 rounded-full">
              Trust Score: 4.6
            </span>
            <span className="text-sm bg-green-100 text-green-700 px-3 py-1 rounded-full">
              فعال
            </span>
          </div>
        </div>
      </section>

      {/* User Info */}
      <section className="grid md:grid-cols-2 gap-4">
        <InfoItem label="ایمیل" value="sara@email.com" />
        <InfoItem label="شماره تماس" value="09120000000" />
        <InfoItem label="تاریخ عضویت" value="1402/05/12" />
      </section>

      {/* My Listings */}
      <section>
        <h2 className="text-xl font-semibold mb-4">آگهی‌های من</h2>

        <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
          <MyListingCard />
          <MyListingCard />
          <MyListingCard />
        </div>
      </section>
    </div>
  );
}

function InfoItem({
  label,
  value,
}: {
  label: string;
  value: string;
}) {
  return (
    <div className="bg-white rounded-xl shadow p-4">
      <p className="text-sm text-slate-500">{label}</p>
      <p className="font-medium mt-1">{value}</p>
    </div>
  );
}

function MyListingCard() {
  return (
    <div className="bg-white rounded-xl shadow p-4 space-y-2">
      <div className="h-32 rounded-lg bg-slate-200" />

      <h3 className="font-semibold">دوربین DSLR Canon</h3>

      <p className="text-sm text-slate-500">
        اجاره روزانه: 150,000 تومان
      </p>

      <div className="flex justify-between items-center">
        <span className="text-xs bg-green-100 text-green-700 px-2 py-1 rounded">
          فعال
        </span>

        <button className="text-sm text-blue-600 hover:underline">
          مشاهده
        </button>
      </div>
    </div>
  );
}
