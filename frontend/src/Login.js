import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';

function Login() {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [loading, setLoading] = useState(false);
    const navigate = useNavigate();

    const handleLogin = async () => {
        if (!email || !password) {
            alert('Please fill in all fields');
            return;
        }

        setLoading(true);

        try {
            const response = await         fetch('http://localhost/my-project-api/backend/login.php', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json' 
                },
                body: JSON.stringify({ email, password })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            
            if (data.api_key) {
                localStorage.setItem('api_key', data.api_key);
                alert('Login successful!');
                navigate('/dashboard');
            } else {
                alert(data.error || 'Login failed');
            }
        } catch (error) {
            console.error('Login error:', error);
            alert('Failed to connect to server. Please check if the backend is running.');
        } finally {
            setLoading(false);
        }
    };

    return (
        <div>
            <h2>Login</h2>
            <input 
                type="email" 
                placeholder="Email" 
                value={email}
                onChange={e => setEmail(e.target.value)} 
            /><br/>
            <input 
                type="password" 
                placeholder="Password" 
                value={password}
                onChange={e => setPassword(e.target.value)} 
            /><br/>
            <button onClick={handleLogin} disabled={loading}>
                {loading ? 'Logging in...' : 'Login'}
            </button>
        </div>
    );
}

export default Login;
