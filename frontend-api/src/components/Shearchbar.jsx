import React from 'react';

const Shearchbar = ({ searchTerm, onSearchChange }) => {
    
    return (
        <nav>
            <input
                type="text"
                placeholder="Search procedures..."
                value={searchTerm}
                onChange={onSearchChange}
                // 💡 Classes do Input:
                // p-3: Padding
                // border: Borda
                // border-gray-300: Cor da borda
                // rounded-lg: Bordas arredondadas
                // shadow-md: Sombra
                // w-full: Largura total
                // focus:ring-2 focus:ring-pink-500: Estilo ao focar
                className="p-3 border border-gray-300 rounded-lg shadow-md w-full focus:outline-none focus:ring-2 focus:ring-pink-500"
            />
        </nav>
    );
};

export default Shearchbar;