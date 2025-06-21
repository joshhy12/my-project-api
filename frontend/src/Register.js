import React, { useState } from 'react';

function Register() {
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');

    const handleRegister = () => {
        fetch('http://localhost/backend/register.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ name, email, password })
        })
        .then(res => res.json())
        .then(data => {
            if (data.api_key) {
                localStorage.setItem('api_key', data.api_key);
                alert('Registration successful!');
            } else {
                alert(data.error);
            }
        });
    };

    return (
        <div>
            <h2>Register</h2>
            <input type="text" placeholder="Name" onChange={e => setName(e.target.value)} /><br/>
            <input type="email" placeholder="Email" onChange={e => setEmail(e.target.value)} /><br/>
            <input type="password" placeholder="Password" onChange={e => setPassword(e.target.value)} /><br/>
            <button onClick={handleRegister}>Register</button>
        </div>
    );
}

export default Register;
