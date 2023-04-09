import { get, post } from './request';

export const generateFixtures = () => get('http://localhost:8000/api/generate-fixtures')
