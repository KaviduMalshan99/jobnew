<div class="employers-grid">
      @foreach ($employers as $employer)
        <div class="employer-card">
          <img src="{{ asset('images/' . $employer['logo']) }}" alt="{{ $employer['alt'] }}">
        </div>
      @endforeach
    </div>

    