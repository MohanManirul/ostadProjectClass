import React from 'react';

const Footer = () => {
    return (       
        <>
            <div className="fixed bottom-0 w-full p-4 text-white bg-blue-700 flex items-center justify-center">
                <p>&copy; Copyright - {new Date().getFullYear()}. All Rights Reserved || Design & Development By Ostad</p>
            </div>
        </>

      
    );
};

export default Footer;