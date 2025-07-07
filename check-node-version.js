#!/usr/bin/env node

/**
 * Node.js Version Compatibility Check for Smart Task Manager
 * This script checks if the current Node.js version is compatible with Vite and the project requirements
 */

const semver = require('semver');
const fs = require('fs');
const path = require('path');

// Colors for console output
const colors = {
    red: '\x1b[31m',
    green: '\x1b[32m',
    yellow: '\x1b[33m',
    blue: '\x1b[34m',
    reset: '\x1b[0m'
};

function log(color, message) {
    console.log(`${colors[color]}${message}${colors.reset}`);
}

function checkNodeVersion() {
    const currentVersion = process.version;
    const requiredVersion = '14.18.0';
    const recommendedVersion = '16.0.0';
    
    log('blue', '🔍 Smart Task Manager - Node.js Version Check');
    log('blue', '================================================');
    
    log('blue', `Current Node.js version: ${currentVersion}`);
    log('blue', `Required minimum version: ${requiredVersion}`);
    log('blue', `Recommended version: ${recommendedVersion}+`);
    
    if (semver.lt(currentVersion, requiredVersion)) {
        log('red', '❌ ERROR: Node.js version is too old!');
        log('red', `Your version: ${currentVersion}`);
        log('red', `Required: ${requiredVersion} or higher`);
        log('yellow', '\n📋 To fix this issue:');
        log('yellow', '1. Update Node.js to version 14.18.0 or higher');
        log('yellow', '2. Use nvm (Node Version Manager) for easier version management:');
        log('yellow', '   - Install nvm: https://github.com/nvm-sh/nvm');
        log('yellow', '   - Run: nvm install 16');
        log('yellow', '   - Run: nvm use 16');
        log('yellow', '3. Or download from: https://nodejs.org/');
        process.exit(1);
    } else if (semver.lt(currentVersion, recommendedVersion)) {
        log('yellow', '⚠️  WARNING: Node.js version is below recommended');
        log('yellow', `Your version: ${currentVersion}`);
        log('yellow', `Recommended: ${recommendedVersion} or higher`);
        log('yellow', 'Consider updating for better performance and compatibility');
    } else {
        log('green', '✅ Node.js version is compatible!');
    }
}

function checkPackageJson() {
    const packageJsonPath = path.join(process.cwd(), 'package.json');
    
    if (!fs.existsSync(packageJsonPath)) {
        log('red', '❌ ERROR: package.json not found!');
        log('red', 'Make sure you are in the project root directory');
        process.exit(1);
    }
    
    try {
        const packageJson = JSON.parse(fs.readFileSync(packageJsonPath, 'utf8'));
        const engines = packageJson.engines;
        
        if (engines && engines.node) {
            log('blue', `Package.json requires Node.js: ${engines.node}`);
            
            if (!semver.satisfies(process.version, engines.node)) {
                log('red', '❌ ERROR: Node.js version does not satisfy package.json requirements!');
                log('red', `Your version: ${process.version}`);
                log('red', `Required: ${engines.node}`);
                process.exit(1);
            } else {
                log('green', '✅ Node.js version satisfies package.json requirements');
            }
        }
    } catch (error) {
        log('red', '❌ ERROR: Could not read package.json');
        log('red', error.message);
        process.exit(1);
    }
}

function checkViteCompatibility() {
    const nodeModulesPath = path.join(process.cwd(), 'node_modules', 'vite');
    
    if (fs.existsSync(nodeModulesPath)) {
        try {
            const vitePackageJson = JSON.parse(
                fs.readFileSync(path.join(nodeModulesPath, 'package.json'), 'utf8')
            );
            
            log('blue', `Vite version: ${vitePackageJson.version}`);
            
            if (vitePackageJson.engines && vitePackageJson.engines.node) {
                log('blue', `Vite requires Node.js: ${vitePackageJson.engines.node}`);
                
                if (!semver.satisfies(process.version, vitePackageJson.engines.node)) {
                    log('red', '❌ ERROR: Node.js version is not compatible with Vite!');
                    log('red', `Your version: ${process.version}`);
                    log('red', `Vite requires: ${vitePackageJson.engines.node}`);
                    process.exit(1);
                } else {
                    log('green', '✅ Node.js version is compatible with Vite');
                }
            }
        } catch (error) {
            log('yellow', '⚠️  Could not check Vite compatibility (Vite not installed yet)');
        }
    } else {
        log('yellow', '⚠️  Vite not found in node_modules (run npm install first)');
    }
}

function main() {
    try {
        checkNodeVersion();
        checkPackageJson();
        checkViteCompatibility();
        
        log('green', '\n🎉 All compatibility checks passed!');
        log('blue', 'You can now run:');
        log('blue', '  npm install');
        log('blue', '  npm run build:production');
        
    } catch (error) {
        log('red', '❌ Unexpected error during compatibility check:');
        log('red', error.message);
        process.exit(1);
    }
}

// Run the checks
main(); 