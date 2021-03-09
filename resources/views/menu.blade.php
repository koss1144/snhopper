<nav class="bg-white px-8 pt-2 mb-6">
    <div class="-mb-px flex justify-center">
        <a class="{{  request()->is('/') ? 'border-b-2' : '' }} no-underline text-teal-dark border-teal-dark uppercase
            tracking-wide font-bold text-xs py-3 mr-8" href="/">
            Home
        </a>
        <a class="{{  request()->is('*admin') ? 'border-b-2' : '' }} no-underline text-teal-dark border-teal-dark uppercase
            tracking-wide font-bold text-xs py-3 mr-8" href="/admin">
            Dashboard
        </a>
        <a class="{{  request()->is('*add-new-property') ? 'border-b-2' : '' }} no-underline text-teal-dark border-teal-dark uppercase
            tracking-wide font-bold text-xs py-3 mr-8" href="/add-new-property">
            Add New Property
        </a>
    </div>
</nav>
