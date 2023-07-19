<h1>Laravel Time Tracking System</h1>

<p>This project is a time tracking system built in Laravel that allows you to manage time dedicated to projects, as well as overtime and overall project management. The backend and views are built using Laravel, and it runs in a Docker environment to facilitate setup and deployment.</p>

<h2>Features</h2>

<ul>
  <li>Track time dedicated to different projects</li>
  <li>Manage overtime and calculate compensation</li>
  <li>Project management functionalities</li>
  <li>Backend and views built with Laravel</li>
  <li>Containerized environment using Docker</li>
</ul>

<h2>Installation</h2>

<p>Follow these steps to install and run the Laravel Time Tracking System:</p>

<ol>
  <li>Clone the repository</li>
  <pre><code>git clone https://github.com/jblasco0595/Limbo-check-time.git</code></pre>
  <li>Install dependencies</li>
  <pre><code>composer install</code></pre>
  <li>Configure the environment</li>
  <pre><code>cp .env.example .env</code></pre>
  <pre><code>php artisan key:generate</code></pre>
  <li>Set up the database</li>
  <pre><code>php artisan migrate</code></pre>
  <li>Start the development server</li>
  <pre><code>php artisan serve</code></pre>
</ol>

<p>Once the development server is running, you can access the Laravel Time Tracking System in your web browser.</p>

<h2>Contributing</h2>

<p>Contributions are welcome! If you have any ideas, suggestions, or bug reports, please open an issue or submit a pull request.</p>
