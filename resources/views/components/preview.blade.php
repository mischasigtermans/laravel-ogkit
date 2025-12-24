@props(['url'])

@php
    $inFilamentPanel = false;
    $inFluxContext = false;

    if (class_exists(\Filament\Facades\Filament::class)) {
        $requestPath = request()->getPathInfo();

        foreach (\Filament\Facades\Filament::getPanels() as $panel) {
            $panelPath = '/' . ltrim($panel->getPath(), '/');
            if (str_starts_with($requestPath, $panelPath)) {
                $inFilamentPanel = true;
                break;
            }
        }

        $filamentPaths = config('ogkit.filament_paths', ['/app']);
        foreach ($filamentPaths as $path) {
            if (str_starts_with($requestPath, $path)) {
                $inFilamentPanel = true;
                break;
            }
        }
    }

    if (class_exists(\Flux\Flux::class) && view()->exists('flux::modal')) {
        $inFluxContext = true;
    }

    $variant = match (true) {
        $inFluxContext => 'flux',
        $inFilamentPanel => 'filament',
        default => 'vanilla',
    };
@endphp

@include("ogkit::components.preview-{$variant}", ['url' => $url])