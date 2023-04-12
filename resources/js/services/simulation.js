import { get, post } from './request';

export const getMatchesOfWeek = (week) => get(`http://localhost:8000/api/play-matches-of-week/${week}`);
