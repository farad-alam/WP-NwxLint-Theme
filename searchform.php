<?php
/**
 * Custom search form for the theme
 */
?>

<form role="search" method="get" class="flex items-center bg-gray-50 border border-gray-200 rounded-lg overflow-hidden" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  
  <!-- Search input -->
  <label for="search-field" class="sr-only">Search for:</label>
  <input 
    type="search" 
    id="search-field"
    class="w-full px-4 py-2 text-gray-700 bg-transparent focus:outline-none"
    placeholder="Search here..."
    value="<?php echo get_search_query(); ?>" 
    name="s"
  >

  <!-- Search button -->
  <button type="submit" class="bg-blue-600 hover:bg-secondary text-white px-4 py-2 transition duration-200">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
    </svg>
  </button>

</form>
