# Asset Bundling with Vite - Smart Task Manager

This guide covers how to use Vite for efficient asset bundling in the Smart Task Manager application.

## 🚀 Overview

Vite is a modern build tool that provides fast development and optimized production builds. Our configuration is specifically tailored for the Smart Task Manager's complex asset structure.

## 📦 Asset Structure

### Current Asset Organization
```
resources/
├── css/
│   └── app.css                 # Main CSS entry point
├── js/
│   ├── app.js                  # Main JS entry point
│   └── bootstrap.js            # Laravel bootstrap
└── assets/
    ├── scss/
    │   ├── style.scss          # Main SCSS file
    │   ├── _variables.scss     # SCSS variables
    │   └── ...                 # Other SCSS modules
    ├── js/
    │   ├── custom.js           # Core functionality
    │   ├── charts.js           # Chart libraries
    │   ├── dashboard/          # Dashboard modules
    │   ├── forms/              # Form components
    │   └── ui/                 # UI components
    └── images/                 # Static images
```

## ⚙️ Vite Configuration Features

### 1. **Multi-Entry Points**
Our Vite config handles multiple entry points for different parts of the application:

```javascript
input: [
    // Core files
    'resources/css/app.css',
    'resources/js/app.js',
    'resources/assets/scss/style.scss',
    
    // Feature-specific modules
    'resources/assets/js/custom.js',
    'resources/assets/js/charts.js',
    'resources/assets/js/dashboard.js',
    // ... more entries
],
```

### 2. **Code Splitting**
Automatic code splitting for better performance:

- **Vendor Chunk**: Third-party libraries (axios, lodash)
- **Charts Chunk**: All chart-related JavaScript
- **Dashboard Chunk**: Dashboard-specific modules
- **Forms Chunk**: Form components and validation
- **UI Chunk**: General UI components

### 3. **Path Aliases**
Convenient path aliases for cleaner imports:

```javascript
// Instead of: import '../../../assets/js/custom.js'
// Use: import '@js/custom.js'

resolve: {
    alias: {
        '@': 'resources',
        '@js': 'resources/assets/js',
        '@scss': 'resources/assets/scss',
        '@images': 'resources/assets/images',
    }
}
```

### 4. **Asset Optimization**
- **Minification**: Terser for JavaScript, built-in for CSS
- **Tree Shaking**: Removes unused code
- **Image Optimization**: Automatic optimization for images
- **Font Handling**: Proper font file processing

## 🛠️ Development Workflow

### Starting Development Server
```bash
# Start Vite development server
npm run dev

# The server will start on http://localhost:5173
# Hot Module Replacement (HMR) is enabled by default
```

### Development Features
- **Hot Module Replacement**: Instant updates without page reload
- **Source Maps**: Easy debugging with original source files
- **Fast Builds**: Extremely fast rebuild times
- **Error Overlay**: Clear error messages in the browser

## 🏗️ Building for Production

### Basic Production Build
```bash
# Standard production build
npm run build

# Clean build (removes previous build first)
npm run clean && npm run build

# Production build with environment variable
npm run build:production
```

### Build Analysis
```bash
# Analyze bundle size and composition
npm run build:analyze

# This generates a visual report of your bundle
```

### Build Output Structure
```
public/build/
├── manifest.json           # Laravel Vite manifest
├── js/
│   ├── app-[hash].js       # Main application
│   ├── vendor-[hash].js    # Third-party libraries
│   ├── charts-[hash].js    # Chart components
│   ├── dashboard-[hash].js # Dashboard modules
│   └── ...
├── css/
│   ├── app-[hash].css      # Compiled CSS
│   └── style-[hash].css    # Main SCSS compilation
├── images/
│   └── [name]-[hash].[ext] # Optimized images
└── fonts/
    └── [name]-[hash].[ext] # Font files
```

## 🎯 Using Assets in Laravel

### In Blade Templates
```php
{{-- Include Vite assets --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])

{{-- Include specific modules --}}
@vite(['resources/assets/scss/style.scss'])
@vite(['resources/assets/js/custom.js'])

{{-- For dashboard pages --}}
@vite([
    'resources/assets/js/index.js',
    'resources/assets/js/charts.js'
])
```

### Dynamic Asset Loading
```javascript
// Dynamically import modules
const chartModule = await import('@js/charts.js');
const dashboardModule = await import('@js/dashboard.js');

// Use with Laravel's asset() helper
const imagePath = `{{ asset('build/images/logo-[hash].png') }}`;
```

## 📊 Performance Optimization

### 1. **Lazy Loading**
```javascript
// Lazy load heavy components
const loadCharts = () => import('@js/charts.js');
const loadDashboard = () => import('@js/dashboard.js');

// Load only when needed
if (document.querySelector('.chart-container')) {
    loadCharts().then(module => {
        module.initCharts();
    });
}
```

### 2. **Preloading Critical Assets**
```php
{{-- Preload critical assets --}}
@vite(['resources/css/app.css'], ['preload' => true])
@vite(['resources/js/app.js'], ['preload' => true])
```

### 3. **Bundle Size Optimization**
- Monitor bundle sizes with `npm run build:analyze`
- Keep chunks under 500KB for optimal loading
- Use dynamic imports for non-critical code
- Optimize images and fonts

## 🔧 Advanced Configuration

### Custom Build Modes
Create `.env.analyze` for bundle analysis:
```env
VITE_ANALYZE=true
```

### Environment-Specific Builds
```javascript
// vite.config.js
export default defineConfig(({ mode }) => {
    const config = {
        // Base configuration
    };
    
    if (mode === 'analyze') {
        config.plugins.push(
            visualizer({
                filename: 'dist/stats.html',
                open: true,
            })
        );
    }
    
    return config;
});
```

### CSS Processing
```scss
// Use path aliases in SCSS
@import '@scss/variables';
@import '@scss/mixins';

// Variables are automatically available
.dashboard {
    color: $primary-color;
    background: $background-color;
}
```

## 🚀 Deployment

### Production Build Process
```bash
# 1. Install dependencies
npm ci --only=production

# 2. Build assets
npm run build:production

# 3. Verify build
ls -la public/build/

# 4. Test with preview server (optional)
npm run preview
```

### Laravel Integration
```php
// In your layout file
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Task Manager</title>
    
    {{-- Vite CSS --}}
    @vite(['resources/css/app.css', 'resources/assets/scss/style.scss'])
</head>
<body>
    {{-- Your content --}}
    
    {{-- Vite JavaScript --}}
    @vite(['resources/js/app.js', 'resources/assets/js/custom.js'])
    
    {{-- Page-specific assets --}}
    @stack('scripts')
</body>
</html>
```

### Page-Specific Assets
```php
{{-- In your Blade view --}}
@push('scripts')
    @vite(['resources/assets/js/charts.js'])
    @vite(['resources/assets/js/dashboard.js'])
@endpush
```

## 🐛 Troubleshooting

### Common Issues

**1. Vite Manifest Not Found**
```bash
# Solution: Build assets first
npm run build
```

**2. SCSS Import Errors**
```scss
// Wrong
@import 'variables';

// Correct
@import '@scss/variables';
```

**3. JavaScript Module Errors**
```javascript
// Wrong
import custom from '../assets/js/custom.js';

// Correct
import custom from '@js/custom.js';
```

**4. HMR Not Working**
```bash
# Check if dev server is running
npm run dev

# Verify port in browser: http://localhost:5173
```

### Performance Issues
```bash
# Check bundle sizes
npm run build:analyze

# Clean and rebuild
npm run clean && npm run build

# Update dependencies
npm update
```

## 📈 Monitoring & Analytics

### Bundle Analysis
```bash
# Generate bundle report
npm run build:analyze

# Check specific chunk sizes
ls -lh public/build/js/
```

### Performance Metrics
- **First Contentful Paint**: Target < 1.5s
- **Largest Contentful Paint**: Target < 2.5s
- **Bundle Size**: Keep chunks < 500KB
- **Load Time**: Monitor with browser dev tools

## 🔄 Migration from Laravel Mix

If migrating from Laravel Mix:

### 1. Remove Mix Files
```bash
rm webpack.mix.js
rm -rf public/js public/css public/mix-manifest.json
```

### 2. Update Blade Templates
```php
{{-- Old Mix syntax --}}
<link href="{{ mix('css/app.css') }}" rel="stylesheet">
<script src="{{ mix('js/app.js') }}"></script>

{{-- New Vite syntax --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

### 3. Update Asset References
```javascript
// Old Mix
require('./components/dashboard.js');

// New Vite
import '@js/dashboard.js';
```

## 📚 Best Practices

1. **Organize Assets Logically**: Group related files together
2. **Use Code Splitting**: Split large bundles into smaller chunks
3. **Optimize Images**: Use appropriate formats and sizes
4. **Monitor Bundle Sizes**: Keep an eye on bundle growth
5. **Use Path Aliases**: Make imports cleaner and more maintainable
6. **Test Production Builds**: Always test builds before deployment
7. **Version Control**: Include `package-lock.json` in version control
8. **Environment Variables**: Use `.env` for environment-specific settings

---

**Smart Task Manager** - Optimized asset bundling with Vite for maximum performance. 