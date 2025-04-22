import axios from 'axios';

export default class ApiTest {
    constructor() {
        this.testApi = this.testApi.bind(this);
    }

    async testApi() {
        const resultDiv = document.getElementById('apiResult');
        resultDiv.innerHTML = '<div class="text-blue-600">Testing API connection...</div>';
        
        try {
            const response = await axios.get('http://localhost:8000/api/test', {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            
            resultDiv.innerHTML = `
                <pre class="text-green-600">
Success! API Response:
${JSON.stringify(response.data, null, 2)}
                </pre>`;
        } catch (error) {
            console.error('API Error:', error);
            
            let errorMessage = 'Unknown error occurred';
            if (error.response) {
                // The request was made and the server responded with a status code
                // that falls out of the range of 2xx
                errorMessage = `Server Error (${error.response.status}): ${JSON.stringify(error.response.data)}`;
            } else if (error.request) {
                // The request was made but no response was received
                errorMessage = 'No response from server. Please check if your Laravel server (php artisan serve) is running.';
            } else {
                // Something happened in setting up the request that triggered an Error
                errorMessage = error.message;
            }
            
            resultDiv.innerHTML = `
                <div class="text-red-600">
                    <p class="font-bold">Error:</p>
                    <p>${errorMessage}</p>
                    <p class="mt-2 text-sm">
                        Please make sure:
                        <ul class="list-disc pl-5">
                            <li>Laravel server is running (php artisan serve)</li>
                            <li>You're using the correct URL</li>
                            <li>CORS is properly configured</li>
                        </ul>
                    </p>
                </div>`;
        }
    }

    render() {
        return `
            <div class="max-w-2xl mx-auto p-6">
                <h2 class="text-2xl font-bold mb-4">API Test Page</h2>
                <div class="mb-4">
                    <p class="text-gray-600">This page tests the connection between your frontend and Laravel API.</p>
                    <p class="text-gray-600">Current API URL: http://localhost:8000/api/test</p>
                </div>
                <button 
                    onclick="window.testApi()"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Test API Connection
                </button>
                <div id="apiResult" class="mt-4 p-4 bg-gray-100 rounded"></div>
            </div>
        `;
    }
} 