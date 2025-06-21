import React, { useState } from 'react';

function Register() {
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [loading, setLoading] = useState(false);

    const handleRegister = async () => {
        if (!name || !email || !password) {
            alert('Please fill in all fields');
            return;
        }

        setLoading(true);
        
        try {
            const response = await fetch('http://localhost/my-project-api/backend/register.php', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ name, email, password })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            
            if (data.api_key) {
                localStorage.setItem('api_key', data.api_key);
                alert('Registration successful!');
                // Clear form
                setName('');
                setEmail('');
                setPassword('');
            } else {
                alert(data.error || 'Registration failed');
            }
        } catch (error) {
            console.error('Registration error:', error);
            alert('Failed to connect to server. Please check if the backend is running.');
        } finally {
            setLoading(false);
        }
    };

    return (
        <div>
            <h2>Register</h2>
            <input 
                type="text" 
                placeholder="Name" 
                value={name}
                onChange={e => setName(e.target.value)} 
            /><br/>
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
            <button onClick={handleRegister} disabled={loading}>
                {loading ? 'Registering...' : 'Register'}
            </button>
        </div>
    );
}

export default Register;
