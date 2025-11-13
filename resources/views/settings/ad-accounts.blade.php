@extends('layouts.settings')

@section('title', 'Ad Accounts')

@section('settings-content')
<h1 class="settings-title">Ad accounts</h1>

<!-- Search Box - Full Width -->
<div class="search-box">
    <input 
        type="text" 
        class="search-input" 
        placeholder="Search" 
        id="searchInput"
    >
    <button type="button" class="search-btn" onclick="performSearch()">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
    </button>
</div>

<!-- Ad Accounts Table -->
<div style="background: white; border-radius: 0.5rem; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; font-size: 0.875rem;">ID</th>
                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; font-size: 0.875rem;">Name</th>
                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; font-size: 0.875rem;">Provider</th>
                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; font-size: 0.875rem;">Timezone</th>
                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; font-size: 0.875rem;">Currency</th>
                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; font-size: 0.875rem;">Status</th>
                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; font-size: 0.875rem;">Created</th>
                <th style="padding: 1rem; text-align: center; font-weight: 600; color: #374151; font-size: 0.875rem;">Actions</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            <!-- Example Row -->
            <tr style="border-bottom: 1px solid #e5e7eb;" class="ad-account-row">
                <td style="padding: 1rem; color: #6b7280; font-size: 0.875rem;">act_188518700157759</td>
                <td style="padding: 1rem; color: #1f2937; font-weight: 500;">Athif Hussain</td>
                <td style="padding: 1rem; color: #6b7280;">Facebook</td>
                <td style="padding: 1rem; color: #6b7280;">Asia/Calcutta</td>
                <td style="padding: 1rem; color: #6b7280;">INR</td>
                <td style="padding: 1rem;">
                    <span style="color: #059669; font-size: 1.25rem;">✓</span>
                </td>
                <td style="padding: 1rem; color: #6b7280; font-size: 0.875rem;">2025-10-27 14:38</td>
                <td style="padding: 1rem;">
                    <div style="display: flex; gap: 0.5rem; justify-content: center;">
                        <!-- Edit Button -->
                        <button style="padding: 0.5rem; background: #374151; color: white; border: none; border-radius: 0.375rem; cursor: pointer;" title="Edit">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                            </svg>
                        </button>
                        
                        <!-- Settings Button -->
                        <button style="padding: 0.5rem; background: #374151; color: white; border: none; border-radius: 0.375rem; cursor: pointer;" title="Settings">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                            </svg>
                        </button>
                        
                        <!-- Delete Button -->
                        <button style="padding: 0.5rem; background: #ef4444; color: white; border: none; border-radius: 0.375rem; cursor: pointer;" title="Delete">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    
    <!-- Pagination -->
    <div style="padding: 1rem; display: flex; justify-content: center; border-top: 1px solid #e5e7eb;">
        <button style="padding: 0.5rem 1rem; background: #374151; color: white; border: none; border-radius: 0.375rem; cursor: pointer; font-weight: 500;">
            1
        </button>
    </div>
</div>

@push('scripts')
<script>
// Search functionality
function performSearch() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    filterTable(searchTerm);
}

// Real-time search on input
document.getElementById('searchInput').addEventListener('input', function(e) {
    filterTable(e.target.value.toLowerCase());
});

// Enter key to search
document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        performSearch();
    }
});

function filterTable(searchTerm) {
    const rows = document.querySelectorAll('.ad-account-row');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
}
</script>
@endpush
@endsection