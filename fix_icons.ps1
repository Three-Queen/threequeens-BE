# ============================================================
# Script: Ganti semua Font Awesome icons → Lucide Icons
# pada seluruh blade view admin
# ============================================================

$viewsDir = "c:\Skripsi Rifky\threequeen\backend\resources\views\admin"

# Mapping FA icon name → Lucide icon name
$map = @{
    'fa-plus'                = 'plus'
    'fa-image'               = 'image'
    'fa-eye'                 = 'eye'
    'fa-edit'                = 'pencil'
    'fa-trash'               = 'trash-2'
    'fa-couch'               = 'sofa'
    'fa-tags'                = 'tags'
    'fa-tag'                 = 'tag'
    'fa-info-circle'         = 'info'
    'fa-save'                = 'save'
    'fa-cloud-upload-alt'    = 'upload-cloud'
    'fa-vector-square'       = 'layout'
    'fa-download'            = 'download'
    'fa-cube'                = 'box'
    'fa-file-alt'            = 'file-text'
    'fa-times'               = 'x'
    'fa-arrow-left'          = 'arrow-left'
    'fa-arrow-right'         = 'arrow-right'
    'fa-building'            = 'building'
    'fa-map-marker-alt'      = 'map-pin'
    'fa-map-marker'          = 'map-pin'
    'fa-calendar'            = 'calendar'
    'fa-map'                 = 'map'
    'fa-check-circle'        = 'check-circle'
    'fa-check'               = 'check'
    'fa-envelope'            = 'mail'
    'fa-phone'               = 'phone'
    'fa-clock'               = 'clock'
    'fa-facebook'            = 'facebook'
    'fa-instagram'           = 'instagram'
    'fa-user'                = 'user'
    'fa-lock'                = 'lock'
    'fa-inbox'               = 'inbox'
    'fa-reply'               = 'reply'
    'fa-key'                 = 'key'
    'fa-camera'              = 'camera'
    'fa-send'                = 'send'
    'fa-whatsapp'            = 'phone'
    'fa-exclamation-triangle'= 'alert-triangle'
    'fa-external-link-alt'   = 'external-link'
    'fa-tiktok'              = 'music-2'
    'fa-chart-bar'           = 'bar-chart-2'
    'fa-bar-chart'           = 'bar-chart-2'
    'fa-project-diagram'     = 'folder-open'
    'fa-box-open'            = 'package-open'
    'fa-bell'                = 'bell'
    'fa-home'                = 'home'
    'fa-info'                = 'info'
    'fa-address-card'        = 'contact'
    'fa-sign-out-alt'        = 'log-out'
    'fa-user-cog'            = 'settings'
    'fa-crown'               = 'crown'
    'fa-tachometer-alt'      = 'layout-dashboard'
    'fa-bell-slash'          = 'bell-off'
    'fa-user-circle'         = 'user-circle'
    'fa-shield-alt'          = 'shield'
    'fa-globe'               = 'globe'
    'fa-link'                = 'link'
    'fa-star'                = 'star'
    'fa-heart'               = 'heart'
    'fa-pencil-alt'          = 'pencil'
    'fa-paper-plane'         = 'send'
    'fa-spinner'             = 'loader'
    'fa-cog'                 = 'settings'
    'fa-power-off'           = 'power'
    'fa-ban'                 = 'ban'
    'fa-search'              = 'search'
    'fa-filter'              = 'filter'
    'fa-sort'                = 'arrow-up-down'
    'fa-refresh'             = 'refresh-cw'
    'fa-sync'                = 'refresh-cw'
    'fa-print'               = 'printer'
    'fa-list'                = 'list'
    'fa-th'                  = 'grid'
    'fa-copy'                = 'copy'
    'fa-paste'               = 'clipboard'
    'fa-eye-slash'           = 'eye-off'
    'fa-angle-left'          = 'chevron-left'
    'fa-angle-right'         = 'chevron-right'
    'fa-angle-up'            = 'chevron-up'
    'fa-angle-down'          = 'chevron-down'
    'fa-bars'                = 'menu'
    'fa-ellipsis-v'          = 'more-vertical'
    'fa-ellipsis-h'          = 'more-horizontal'
    'fa-question-circle'     = 'help-circle'
    'fa-exclamation-circle'  = 'alert-circle'
    'fa-times-circle'        = 'x-circle'
    'fa-toggle-on'           = 'toggle-right'
    'fa-toggle-off'          = 'toggle-left'
    'fa-lightbulb'           = 'lightbulb'
    'fa-bolt'                = 'zap'
    'fa-wifi'                = 'wifi'
    'fa-shield'              = 'shield'
    'fa-folder'              = 'folder'
    'fa-folder-open'         = 'folder-open'
    'fa-file'                = 'file'
    'fa-paperclip'           = 'paperclip'
    'fa-upload'              = 'upload'
    'fa-cloud-upload'        = 'upload-cloud'
    'fa-thumbs-up'           = 'thumbs-up'
    'fa-thumbs-down'         = 'thumbs-down'
    'fa-flag'                = 'flag'
    'fa-bookmark'            = 'bookmark'
    'fa-share'               = 'share-2'
    'fa-comment'             = 'message-circle'
    'fa-comments'            = 'message-square'
}

# Size class mapping (FA text-size → Lucide w-h)
function Get-Size($extra) {
    if ($extra -match 'text-(5xl|6xl|7xl)')  { return 'w-10 h-10' }
    if ($extra -match 'text-(3xl|4xl)')      { return 'w-8 h-8'   }
    if ($extra -match 'text-(xl|2xl)')       { return 'w-6 h-6'   }
    if ($extra -match 'text-lg')             { return 'w-5 h-5'   }
    if ($extra -match 'text-xs')             { return 'w-3.5 h-3.5' }
    return 'w-4 h-4'
}

$totalFiles  = 0
$totalIcons  = 0

$files = Get-ChildItem $viewsDir -Filter "*.blade.php" -Recurse

foreach ($file in $files) {
    $content  = [IO.File]::ReadAllText($file.FullName)
    $original = $content
    $fileIcons = 0

    # Sort keys longest-first to avoid partial-match issues (e.g. fa-map before fa-map-marker-alt)
    $sortedKeys = $map.Keys | Sort-Object Length -Descending

    foreach ($faIcon in $sortedKeys) {
        $lucide = $map[$faIcon]

        # Escape for regex
        $escaped = [regex]::Escape($faIcon)

        # Match: class="fas fa-X...rest..."
        $pattern = "class=`"fas\s+$escaped([^`"]*)`""

        $content = [regex]::Replace($content, $pattern, {
            param($m)
            $rest = $m.Groups[1].Value

            $sz     = Get-Size $rest
            $colors = $rest -replace '\s*\btext-(xs|sm|base|lg|xl|2xl|3xl|4xl|5xl|6xl|7xl)\b', ''
            $colors = $colors.Trim() -replace '\s+', ' '

            $cls = if ($colors) { "$sz $colors" } else { $sz }
            return "data-lucide=`"$lucide`" class=`"$cls`""
        })

        # Count replacements
        $diff = ([regex]::Matches($original, "fas\s+$escaped")).Count
        $fileIcons += $diff
    }

    if ($content -ne $original) {
        [IO.File]::WriteAllText($file.FullName, $content)
        Write-Host "OK $($file.Name) - $fileIcons icon(s) diganti" -ForegroundColor Green
        $totalFiles++
        $totalIcons += $fileIcons
    } else {
        Write-Host "SKIP $($file.Name) - tidak ada perubahan" -ForegroundColor Gray
    }
}

Write-Host ""
Write-Host "============================================" -ForegroundColor Cyan
Write-Host "Selesai! $totalFiles file diupdate, $totalIcons icon diganti." -ForegroundColor Cyan
Write-Host "============================================" -ForegroundColor Cyan
