import './bootstrap';
import ApiTest from './components/ApiTest';

// Initialize ApiTest instance
const apiTest = new ApiTest();

// Make testApi function globally available
window.testApi = () => apiTest.testApi();

// Render the API test component when the page loads
document.addEventListener('DOMContentLoaded', () => {
    const app = document.getElementById('app');
    if (app) {
        app.innerHTML = apiTest.render();
    }
});
