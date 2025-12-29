import React from "react";
import "./NotFound404.css";

const NotFound404: React.FC = () => {
  return (
    <div className="bg-gray-100 h-screen justify-center">
      
      <div className="mt-6 text-center">
        <a
          href="/mainPage"
          className="text-gray-500 font-mono text-xl bg-gray-200 p-3 rounded-md hover:shadow-md"
        >
          Go back
        </a>
      </div>
    </div>
  );
};

export default NotFound404;
