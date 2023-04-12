import { get, post } from './request';

export const generateFixtures = () => get('http://localhost:8000/api/generate-fixtures');

export const getFixtures = () => get('http://localhost:8000/api/get-fixtures');

export const regenerateFixtures = () => get('http://localhost:8000/api/regenerate-fixtures');

export const getMatchesOfWeek = (week) => get(`http://localhost:8000/api/get-matches-of-week/${week}`);

export const playAllWeeks = (week) => get('http://localhost:8000/api/play-all-weeks');

export const playMatchesOfWeek = (week) => get(`http://localhost:8000/api/play-matches-of-week/${week}`);

export const resetData = () => get('http://localhost:8000/api/reset-data');
