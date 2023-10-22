import React from 'react';

const AvatarDisplay = ({ avatar }) => {
    return (
        <div>
            {avatar ? (
                <a href="#" className="booking-doc-img">
                    <img src={avatar} alt="User Image" />
                </a>
            ) : (
                <div className="default-avatar booking-doc-img">
                    <img src="https://dvdn247.net/wp-content/uploads/2020/07/avatar-mac-dinh-1.png" alt="Default Avatar" />
                </div>
            )}
        </div>
    );
};

export default AvatarDisplay;
