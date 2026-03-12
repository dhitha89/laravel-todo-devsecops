# laravel-todo-devsecops 

A Laravel 12 Todo application with an end-to-end DevSecOps pipeline.

## About
This project demonstrates a full DevSecOps pipeline for a Laravel application including code quality checks, security scanning, and automated deployment.

## Tech Stack
- Laravel 12
- PHP 8.2
- MySQL
- Docker
- GitHub Actions

## DevSecOps Pipeline
- ⬜ Code Quality (Laravel Pint)
- ⬜ Secrets Scanning (Gitleaks)
- ⬜ Dependency Scanning (Composer Audit)
- ⬜ Docker Linting (Hadolint)
- ⬜ Automated Tests (PHPUnit)
- ⬜ Docker Image Scan (Trivy)
- ⬜ Auto Deploy

## Project Description

**laravel-todo-devsecops** is a Laravel 12 Todo application built to demonstrate a complete End-to-End DevSecOps pipeline using GitHub Actions.

The application is a simple but fully functional Todo manager built with Laravel 12 and Breeze authentication. Users can register, login, create tasks, mark them as complete and delete them.

The main focus of this project is the **DevSecOps pipeline** which automatically runs on every push to main:

- **Code Quality** — Laravel Pint checks PHP code style and formatting
- **Secrets Scan** — Gitleaks scans the codebase for accidentally committed secrets, API keys or passwords
- **Dependency Scan** — Composer Audit checks all PHP dependencies for known vulnerabilities
- **Dockerfile Lint** — Hadolint checks the Dockerfile for best practices and security issues
- **Automated Tests** — PHPUnit runs all feature tests against a real MySQL database
- **Docker Build & Push** — Builds a production Docker image and pushes to DockerHub with three tags (latest, branch, commit SHA)
- **Image Scan** — Trivy scans the built Docker image for critical and high CVEs before it can be deployed

This pipeline ensures that no broken, insecure or poorly written code can reach production.

## Author
Sharmila
