import React from "react";

const DashboardLayout: React.FC = () => {
  return (
    <div className="flex w-screen h-screen text-blue-500">
      {/* Component Start */}
      <div className="flex flex-col items-center w-16 pb-4 overflow-auto border-r border-gray-300">
        <a className="flex items-center justify-center flex-shrink-0 w-full h-16 bg-gray-300" href="#">
          <svg className="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
          </svg>
        </a>

        {[
          "M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6",
          "M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z",
          "M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4",
          "M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z",
          "M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4",
        ].map((d, i) => (
          <a key={i} className="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4 rounded hover:bg-gray-300" href="#">
            <svg className="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d={d} />
            </svg>
          </a>
        ))}

        <a className="flex items-center justify-center flex-shrink-0 w-10 h-10 mt-4 rounded hover:bg-gray-300" href="#">
          <svg className="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </a>
      </div>

      <div className="flex flex-col w-56 border-r border-gray-300">
        <button className="relative text-sm focus:outline-none group">
          <div className="flex items-center justify-between w-full h-16 px-4 border-b border-gray-300 hover:bg-gray-300">
            <span className="font-medium">Dropdown</span>
            <svg className="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fillRule="evenodd" clipRule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
            </svg>
          </div>
          <div className="absolute z-10 hidden w-full pb-1 bg-white shadow-lg group-focus:flex flex-col">
            <a className="w-full px-4 py-2 text-left hover:bg-gray-300" href="#">Menu Item 1</a>
            <a className="w-full px-4 py-2 text-left hover:bg-gray-300" href="#">Menu Item 2</a>
            <a className="w-full px-4 py-2 text-left hover:bg-gray-300" href="#">Menu Item 3</a>
          </div>
        </button>

        <div className="flex flex-col flex-grow p-4 overflow-auto">
          {[1, 2, 3, 4, 5, 6].map((i) => (
            <a key={i} className="flex items-center h-10 px-2 text-sm font-medium rounded hover:bg-gray-300" href="#">
              Item {i}
            </a>
          ))}

          <a className="flex items-center h-10 px-3 mt-auto text-sm font-medium bg-gray-200 rounded hover:bg-gray-300" href="#">
            <svg className="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <span className="ml-2">New Item</span>
          </a>
        </div>
      </div>

      <div className="flex flex-col flex-grow">
        <div className="flex items-center h-16 px-8 border-b border-gray-300">
          <h1 className="text-lg font-medium">Page Title</h1>
          <button className="h-10 px-4 ml-auto text-sm font-medium rounded hover:bg-gray-300">Action 1</button>
          <button className="h-10 px-4 ml-2 text-sm font-medium bg-gray-200 rounded hover:bg-gray-300">Action 2</button>
        </div>

        <div className="flex-grow p-6 overflow-auto bg-gray-200">
          <div className="grid grid-cols-3 gap-6">
            {Array.from({ length: 24 }).map((_, i) => (
              <div
                key={i}
                className={`h-24 bg-white border border-gray-300 col-span-${[1, 1, 1, 2, 1, 1, 2, 3][i % 8]}`}
              />
            ))}
          </div>
        </div>
      </div>
      {/* Component End */}
    </div>
  );
};

export default DashboardLayout;
