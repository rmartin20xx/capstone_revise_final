import React, { useState } from 'react';
import axios from 'axios';
import '../admin/css/login.css';

const Login = () => {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [errorMessage, setErrorMessage] = useState('');

  const handleUsernameChange = (event) => {
    setUsername(event.target.value);
  };

  const handlePasswordChange = (event) => {
    setPassword(event.target.value);
  };

  const handleSubmit = async (event) => {
    event.preventDefault();

    try {
      // Make a POST request to the PHP API endpoint using Axios
      const response = await axios.post(
        'http://localhost/hotel_resort_final/api/user_login.php',
        {
          username: username,
          password: password,
        }
      );

      // Handle the response from the PHP API
      const { success, message } = response.data;
      if (success) {
        // Authentication successful, perform further actions or redirect
        console.log('Login successful');
        // Redirect to the dashboard or perform other actions
      } else {
        // Authentication failed, display error message
        setErrorMessage(message);
      }
    } catch (error) {
      // Handle any errors that occurred during the request
      console.error('Error occurred:', error);
      // Display a generic error message
      setErrorMessage('An error occurred during login. Please try again.');
    }
  };

  return (
    <div className="login-container">
      <h2>Login</h2>
      <form className="login-form" onSubmit={handleSubmit}>
        <div>
          <label htmlFor="username">Username</label>
          <input
            type="text"
            id="username"
            value={username}
            onChange={handleUsernameChange}
          />
        </div>
        <div>
          <label htmlFor="password">Password</label>
          <input
            type="password"
            id="password"
            value={password}
            onChange={handlePasswordChange}
          />
        </div>
        {errorMessage && <p>{errorMessage}</p>}
        <button type="submit">Log In</button>
      </form>
    </div>
  );
};

export default Login;
