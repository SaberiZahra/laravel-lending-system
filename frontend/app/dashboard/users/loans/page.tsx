export default function LoansPage() {
  return (
    <div className="space-y-8">
      {/* Page Header */}
      <header>
        <h1 className="text-2xl font-bold">درخواست‌ها</h1>
        <p className="text-slate-500 mt-1">
          وضعیت درخواست‌های امانت شما
        </p>
      </header>

      {/* Loans List */}
      <section className="space-y-4">
        <LoanCard
          title="دوربین DSLR Canon"
          borrower="محمد رضایی"
          startDate="1403/02/10"
          endDate="1403/02/15"
          status="pending"
        />

        <LoanCard
          title="پلی‌استیشن 5"
          borrower="علی احمدی"
          startDate="1403/01/20"
          endDate="1403/01/25"
          status="approved"
        />

        <LoanCard
          title="هارد اکسترنال 2TB"
          borrower="—"
          startDate="1402/12/05"
          endDate="1402/12/10"
          status="returned"
        />
      </section>
    </div>
  );
}

function LoanCard({
  title,
  borrower,
  startDate,
  endDate,
  status,
}: {
  title: string;
  borrower: string;
  startDate: string;
  endDate: string;
  status: "pending" | "approved" | "returned" | "rejected";
}) {
  const statusMap = {
    pending: {
      label: "در انتظار تأیید",
      className: "bg-amber-100 text-amber-700",
    },
    approved: {
      label: "تأیید شده",
      className: "bg-blue-100 text-blue-700",
    },
    returned: {
      label: "بازگردانده شده",
      className: "bg-green-100 text-green-700",
    },
    rejected: {
      label: "رد شده",
      className: "bg-red-100 text-red-700",
    },
  };

  const s = statusMap[status];

  return (
    <div className="bg-white rounded-2xl shadow p-6 space-y-3">
      <div className="flex justify-between items-start">
        <h3 className="font-semibold text-lg">{title}</h3>
        <span
          className={`text-xs px-3 py-1 rounded-full ${s.className}`}
        >
          {s.label}
        </span>
      </div>

      <div className="text-sm text-slate-600 space-y-1">
        <p>امانت‌گیرنده: {borrower}</p>
        <p>
          بازه امانت: {startDate} تا {endDate}
        </p>
      </div>

      {/* Actions */}
      {status === "pending" && (
        <div className="flex gap-2 pt-2">
          <button className="px-4 py-2 rounded-lg bg-green-600 text-white text-sm hover:bg-green-700">
            تأیید
          </button>
          <button className="px-4 py-2 rounded-lg bg-red-600 text-white text-sm hover:bg-red-700">
            رد
          </button>
        </div>
      )}
    </div>
  );
}
