<div>
            <h2>{{ $meal['strMeal'] ?? 'No meal name available' }}</h2>

            <img src="{{ $meal['strMealThumb'] }}" alt="{{ $meal['strMeal'] }}" width="300">

            <p><strong>Kategorie:</strong> {{ $meal['strCategory'] ?? 'No category available' }}</p>
            <p><strong>Tags:</strong> {{ $meal['strTags'] ?? 'No tags available' }}</p>
            <p><strong>Herkunft:</strong> {{ $meal['strArea'] ?? 'No origin available' }}</p>
            <p>{{ $meal['strInstructions'] ?? 'No instructions available' }}</p>
            <a href="{{ $meal['strYoutube'] ?? '#' }}" target="_blank">Link</a>
</div>
