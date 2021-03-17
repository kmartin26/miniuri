<nav class="flex md:ml-auto">
    <ul class="flex space-x-6 text-lg text-white">
        <li>
            <a class="{{ (request()->routeIs('home')) ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
        </li>
        <li>
            <a class="{{ (request()->routeIs('docs')) ? 'active' : '' }}" href="{{ route('docs') }}">API</a>
        </li>
        <li>
            <a class="{{ (request()->routeIs('contact')) ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
        </li>
    </ul>
</nav>