# Production Deployment Guide - Smart Task Manager

This guide helps you deploy the Smart Task Manager to production servers, especially dealing with Node.js compatibility issues.

## 🚨 Common Issues & Solutions

### Issue 1: Node.js Version Compatibility Error

**Error:**
```
SyntaxError: Unexpected token {
    at Module._compile (internal/modules/cjs/loader.js:723:23)
```

**Cause:** Production server is running an older version of Node.js that doesn't support ES modules.

**Solution:**

#### Step 1: Check Node.js Version
```bash
# Check current Node.js version
node --version

# Check npm version
npm --version
```

#### Step 2: Update Node.js (if needed)

**Option A: Using Node Version Manager (nvm) - Recommended**
```bash
# Install nvm
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash

# Restart terminal or source profile
source ~/.bashrc

# Install and use Node.js 16 (LTS)
nvm install 16
nvm use 16
nvm alias default 16

# Verify installation
node --version  # Should show v16.x.x
```

**Option B: Direct Installation**
```bash
# For Ubuntu/Debian
curl -fsSL https://deb.nodesource.com/setup_16.x | sudo -E bash -
sudo apt-get install -y nodejs

# For CentOS/RHEL
curl -fsSL https://rpm.nodesource.com/setup_16.x | sudo bash -
sudo yum install -y nodejs

# Verify installation
node --version
npm --version
```

#### Step 3: Run Compatibility Check
```bash
# Run our compatibility check script
node check-node-version.js
```

## 🔧 Production Build Process

### Step 1: Clean Installation
```bash
# Remove existing node_modules and package-lock.json
rm -rf node_modules package-lock.json

# Clear npm cache
npm cache clean --force

# Install dependencies
npm ci --only=production
```

### Step 2: Install Development Dependencies
```bash
# Install dev dependencies needed for build
npm install --only=dev
```

### Step 3: Build Assets
```bash
# Clean previous build
npm run clean

# Build for production
npm run build:production
```

### Step 4: Verify Build
```bash
# Check build output
ls -la public/build/

# Verify manifest exists
cat public/build/manifest.json
```

## 🚀 Alternative Build Methods

### Method 1: Using Specific Node.js Version
```bash
# If you have multiple Node.js versions
nvm use 16
npm run build:production
```

### Method 2: Using Docker (if available)
```bash
# Create a Dockerfile for building
cat > Dockerfile.build << 'EOF'
FROM node:16-alpine
WORKDIR /app
COPY package*.json ./
RUN npm ci --only=production
RUN npm install --only=dev
COPY . .
RUN npm run build:production
EOF

# Build using Docker
docker build -f Dockerfile.build -t task-manager-build .
docker run --rm -v $(pwd)/public/build:/app/public/build task-manager-build
```

### Method 3: Build Locally and Upload
```bash
# Build on local machine (with compatible Node.js)
npm run build:production

# Upload build directory to server
rsync -avz public/build/ user@server:/path/to/project/public/build/
```

## 🐛 Troubleshooting

### Issue: "Cannot find module 'vite/bin/vite.js'"
```bash
# Solution: Reinstall Vite
npm uninstall vite
npm install vite@^3.2.8 --save-dev
```

### Issue: "EACCES: permission denied"
```bash
# Solution: Fix npm permissions
sudo chown -R $(whoami) ~/.npm
sudo chown -R $(whoami) /usr/local/lib/node_modules
```

### Issue: "gyp ERR! stack Error: not found: make"
```bash
# Solution: Install build tools
# Ubuntu/Debian
sudo apt-get install build-essential

# CentOS/RHEL
sudo yum groupinstall "Development Tools"
```

### Issue: Out of memory during build
```bash
# Solution: Increase Node.js memory limit
NODE_OPTIONS="--max-old-space-size=4096" npm run build:production
```

## 📋 Production Checklist

### Before Deployment
- [ ] Node.js version >= 14.18.0 (recommended: 16.x)
- [ ] npm version >= 6.0.0
- [ ] Run `node check-node-version.js`
- [ ] All dependencies installed
- [ ] Build process completes successfully

### Environment Setup
- [ ] Set `NODE_ENV=production`
- [ ] Configure `.env` file for production
- [ ] Set up proper file permissions
- [ ] Configure web server (Apache/Nginx)

### Build Verification
- [ ] `public/build/` directory exists
- [ ] `public/build/manifest.json` exists
- [ ] JavaScript files are minified
- [ ] CSS files are compiled
- [ ] Images are optimized

### Laravel Integration
- [ ] Update Blade templates to use `@vite()` directive
- [ ] Clear Laravel caches: `php artisan cache:clear`
- [ ] Clear view cache: `php artisan view:clear`
- [ ] Clear config cache: `php artisan config:clear`

## 🔄 Automated Deployment Script

Create a deployment script for easier production builds:

```bash
#!/bin/bash
# deploy.sh

set -e

echo "🚀 Smart Task Manager - Production Deployment"
echo "============================================="

# Check Node.js version
echo "📋 Checking Node.js compatibility..."
node check-node-version.js

# Clean previous build
echo "🧹 Cleaning previous build..."
npm run clean

# Install dependencies
echo "📦 Installing dependencies..."
npm ci --only=production
npm install --only=dev

# Build assets
echo "🔨 Building production assets..."
NODE_ENV=production npm run build:production

# Verify build
echo "✅ Verifying build..."
if [ -f "public/build/manifest.json" ]; then
    echo "✅ Build successful!"
    echo "📊 Build statistics:"
    ls -lh public/build/js/ | head -10
    echo "..."
else
    echo "❌ Build failed - manifest.json not found"
    exit 1
fi

# Laravel optimizations
echo "🔧 Optimizing Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "🎉 Deployment completed successfully!"
```

Make it executable:
```bash
chmod +x deploy.sh
```

Run deployment:
```bash
./deploy.sh
```

## 📞 Support

If you encounter issues:

1. **Check Node.js version**: `node --version` (must be >= 14.18.0)
2. **Run compatibility check**: `node check-node-version.js`
3. **Check build logs** for specific error messages
4. **Try building locally** first to isolate server issues
5. **Consider using Docker** for consistent build environment

## 🔗 Useful Links

- [Node.js Official Downloads](https://nodejs.org/)
- [Node Version Manager (nvm)](https://github.com/nvm-sh/nvm)
- [Vite Documentation](https://vitejs.dev/)
- [Laravel Vite Plugin](https://github.com/laravel/vite-plugin)

---

**Smart Task Manager** - Production deployment made easy! 🚀 