import { get, post } from './request';

export const getTeams = () => get('http://localhost:8000/api/get-teams')
