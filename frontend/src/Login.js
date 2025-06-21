import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';

function Login() {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const navigate = useNavigate();

    const handleLogin = () => {
        fetch('http://localhost/backend/login.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, password })
        })
        .then(res => res.json())
        .then(data => {
            if (data.api_key) {
                localStorage.setItem('api_key', data.api_key);
                alert('Login successful!');
                navigate('/dashboard');
            } else {
                alert(data.error);
            }
        });
    };

    return (
        <div>
            <h2>Login</h2>
            <input type="email" placeholder="Email" onChange={e => setEmail(e.target.value)} /><br/>
            <input type="password" placeholder="Password" onChange={e => setPassword(e.target.value)} /><br/>
            <button onClick={handleLogin}>Login</button>
        </div>
    );
}

export default Login;
