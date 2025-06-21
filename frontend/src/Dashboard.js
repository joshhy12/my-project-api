import React, { useEffect, useState } from 'react';

function Dashboard() {
    const [message, setMessage] = useState('');

    useEffect(() => {
        const apiKey = localStorage.getItem('api_key');

        fetch('http://localhost/backend/dashboard.php', {
            headers: { 'Authorization': apiKey }
        })
        .then(res => res.json())
        .then(data => setMessage(data.message))
        .catch(err => console.error(err));
    }, []);

    return (
        <div>
            <h2>Dashboard</h2>
            <p>{message}</p>
        </div>
    );
}

export default Dashboard;
