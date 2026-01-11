import React from "react";

const SearchBarprodutos = ({ value, onChange }) => {
  return (
    <input
      type="text"
      placeholder="Buscar produtos..."
      value={value}
      onChange={onChange}
      className="p-3 border border-gray-300 rounded-lg shadow-md w-full focus:outline-none focus:ring-2 focus:ring-pink-500"
    />
  );
};

export default SearchBarprodutos;
