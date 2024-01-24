<div class="section" id="user-section">
    <div id="user-detail">
        <div class="avatar">
            <img src="{{ asset('picture/accounts/' . $employee->photo ) }}" alt="avatar" class="imaged w64 rounded">
        </div>
    
        <div id="user-info">
            <h2 id="user-name">{{ $employee->fullname }}</h2>
            <span id="user-role">{{ $employee->position->name . " / " . $employee->departement->name }}</span>
            
        </div>
    </div>
</div>