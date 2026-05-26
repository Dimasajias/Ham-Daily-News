import re

with open('public/css/filament-custom.css', 'r') as f:
    lines = f.readlines()

targets = [
    ".fi-body", ".fi-sidebar", ".fi-ta", ".fi-ta-header-cell", 
    ".fi-ta-row td", ".fi-ta-cell", ".fi-ta-header-toolbar", 
    ".fi-ta-pagination", ".fi-ta-row-striped", ".fi-section", 
    ".fi-section-header", ".fi-section-header-heading", 
    ".fi-wi-stats-overview-stat", ".fi-wi-stats-overview-stat-value", 
    ".fi-input-wrp", ".fi-fo-field-wrp label", ".fi-modal-window", 
    ".fi-modal-heading", ".fi-wi-account-widget", ".fi-header-heading",
    ".fi-ta-empty-state-heading"
]

out = []
for line in lines:
    stripped = line.strip()
    if stripped.endswith("{") or stripped.endswith(","):
        for t in targets:
            if stripped.startswith(t):
                # Replace the target at the start of the line
                line = line.replace(t, f"html:not(.dark) {t}", 1)
                break
    out.append(line)

with open('public/css/filament-custom.css', 'w') as f:
    f.writelines(out)
